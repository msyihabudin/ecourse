<?php defined('BASEPATH') OR exit('No direct script access allowed');

class PostModel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('catmodel');
		
	}

	public function get_posts()
	{
		 return $this->db->order_by('date_posted', 'DESC')->get('posts')->result();
	}

	public function get_post($id)
	{
		// get the post
		$post = $this->db->where('id', $id)->limit(1)->get('posts')->row_array();

		// get post's categories
		$query_cats = $this->db->select('category_id')->where('post_id', $post['id'])->get('posts_to_categories')->result_array();

		// build for multi-select
		foreach ($query_cats as $k => $v)
		{
			$post['selected_cats'][] = $v['category_id'];
		}

		// build the multi-select 
		$post['cats'] = $this->get_cats_form();

		// return 
		return $post;
	}

	public function add_post($data)
	{
		// separate the categories from 
		// post data
		$cats = $data['cats'];
		unset($data['cats']);

		// attempt to insert the post
		if ($this->db->insert('posts', $data))
		{
			// it works, so get the new id
			$new_post_id = $this->db->insert_id();

			// attempt to add the categories
			if ($this->insert_cats_to_post($new_post_id, $cats))
			{
				// everything went well
				if ($data['status'] == 'published')
				{
					$this->load->library('markdown');
					// email subscribers
					// get subscribers
					$subs = $this->db->where('verified', 1)->get('notifications')->result();

					foreach ($subs as $sub)
					{
						$this->ecore->send_email( $sub->email_address, $data['title'] . ' - ' . $this->config->item('site_name'), lang('post_new_post_notification_msg') . $this->markdown->parse($data['content']) . lang('post_new_post_notification_msg_foot') . '[<a href="' . site_url('notices/unsub') . '">Unsubscribe</a>]');
					}
					
				}
				
				return true;
			}

			// couldn't insert the post
			return false;
		}

		// default failure
		return false;
	}

	public function update_post($id, $data)
	{
		$old = $this->db->where('id', $id)->limit(1)->get('posts')->row();
		// separate the categories
		$cats = $data['cats'];
		unset($data['cats']);

		// update the curent record and categories
		if ($this->db->where('id', $id)->update('posts', $data) && $this->update_cats_to_post($id, $cats))
		{
			// if we've updated a post and we're taking a formerly 'draft' post
			// to 'published', we should send out the notices.
			if ($data['status'] == 'published' && $old->status == 'draft')
			{
				$this->load->library('markdown');
				// email subscribers
				// get subscribers
				$subs = $this->db->where('verified', 1)->get('notifications')->result();

				foreach ($subs as $sub)
				{
					$this->ecore->send_email( $sub->email_address, $data['title'] . ' - ' . $this->config->item('site_name'), lang('post_new_post_notification_msg') . $this->markdown->parse($data['content']) . lang('post_new_post_notification_msg_foot') . '[<a href="' . site_url('notices/unsub') . '">Unsubscribe</a>]');
				}		
			}
			// woot!
			return true;
		}
		// default failure
		return false;
	}

	public function remove_post($id)
	{
		// get the outgoing post information
		$post = $this->db->where('id', $id)->limit(1)->get('posts')->row();

		// does this post have redirects that need
		// to be removed as well?
		$this->ecore->remove_redirects($post->url_title);

		$this->remove_post_to_cats($id);
		
		return $this->db->delete('posts', ['id' => $id]);
	}
	
	public function remove_post_to_cats($post_id)
	{
		return $this->db->delete('posts_to_categories', ['post_id' => $post_id]);
	}

	public function update_cats_to_post($post_id, $cats)
	{
		// do we have needed info?
		if ( ! $cats || ! $post_id )
		{
			// fail
			return false;
		}

		// help switch on success...
		$return = true;

		// get the current categories for the post
		$cur_cats = $this->db->where('post_id', $post_id)->get('posts_to_categories')->result_array();

		// decide which goes where, if anything...
		// we foreach loop through the current categories
		// for the post
		// then we foreach loop through the incoming new categories
		foreach ($cur_cats as $c_k => $c_v)
		{
			foreach ($cats as $k => $v)
			{
				// if we find a match we unset both arrays because
				// we don't need to do anything with that record
				if ($v == $c_v['category_id'] && $c_v['post_id'] == $post_id)
				{
					unset($cats[$k]);
					unset($cur_cats[$c_k]);
				}			
			}
		}
		// what's left in the respective arrays is what we
		// need to remove or add.

		// delete categories
		if ( $cur_cats )
		{
			foreach ($cur_cats as $cat)
			{
				if (! $this->db->where('id', $cat['id'])->delete('posts_to_categories') )
				{
					$return = false;
				}
			}
		}

		// insert new categories
		if ( $cats && $return == true)
		{
			return $this->insert_cats_to_post($post_id, $cats);
		}

		return true;
	}
	
	public function insert_cats_to_post($post_id, $cats)
	{
		// build insert array
		foreach ($cats as $k => $v)
		{
			$insert[] = ['post_id' => $post_id, 'category_id' => $v];
		}

		// attempt to insert categories for the post
		if ($this->db->insert_batch('posts_to_categories', $insert))
		{
			// yay!
			return true;
		}

		// boo!
		return false;
	}

	public function get_cats_form()
	{
		// get'm
		$cats = $this->db->select('id, name')->get('categories')->result_array();

		// default empty array
		$ret = [];

		// foreach getting id and name
		foreach ($cats as $k => $v)
		{
			$ret[$v['id']] = $v['name'];
		}

		// return array
		return $ret;
	}

	public function get_home_bignews($offset = 0)
	{
		// today's date
		$current_date = date('Y-m-d');

		$select = array(
			'posts.*', 'users.fullname'
			);
		
		// rediculous db call
		$this->db->select($select)
					->from('posts')
					->join('users', 'posts.author = users.users_id')
					->join('posts_to_categories', 'posts.id = posts_to_categories.post_id')
					->where('posts.status', 'published')
					->where('posts.date_posted <= ', $current_date)
					->where('posts_to_categories.category_id', 5)
					->order_by('posts.date_posted', 'DESC')
					->order_by('posts.id', 'DESC')
					->limit(1, $offset);
			
		$query = $this->db->get();

		//print_r($query->result_array());
		
		// did we find anything?	
		if ($query->num_rows() > 0)
		{
			// yes...
			$result['posts'] = $query->result_array();

			// process for needed fields.
			foreach ($result['posts'] as &$item)
			{
				$item['url'] = news_url($item['url_title'], $item['date_posted']);
				$item['display_name'] = $item['fullname'];
				$item['categories'] = $this->catmodel->get_categories_by_ids($this->get_post_categories($item['id']));
				$item['date_posted'] = DateTime::createFromFormat('Y-m-d', $item['date_posted'])->format('D M d Y');
			}

			$result['post_count'] = $query->num_rows();

			return json_decode(json_encode($result));
		}

		// failed... bounce.
		return array();
	}

	public function get_home_news($offset = 1)
	{
		// today's date
		$current_date = date('Y-m-d');
		$select = array(
			'posts.*', 'users.fullname'
			);
		
		// rediculous db call
		$this->db->select($select)
					->from('posts')
					->join('users', 'posts.author = users.users_id')
					->join('posts_to_categories', 'posts.id = posts_to_categories.post_id')
					->where('posts.status', 'published')
					->where('posts.date_posted <= ', $current_date)
					->where('posts_to_categories.category_id', 5)
					->order_by('posts.date_posted', 'DESC')
					->order_by('posts.id', 'DESC')
					->limit(4, $offset);
			
		$query = $this->db->get();
		
		// did we find anything?	
		if ($query->num_rows() > 0)
		{
			// yes...
			$result['posts'] = $query->result_array();

			// process for needed fields.
			foreach ($result['posts'] as &$item)
			{
				$item['url'] = news_url($item['url_title'], $item['date_posted']);
				$item['display_name'] = $item['fullname'];
				$item['categories'] = $this->catmodel->get_categories_by_ids($this->get_post_categories($item['id']));
				$item['date_posted'] = DateTime::createFromFormat('Y-m-d', $item['date_posted'])->format('D M d Y');
			}

			$result['post_count'] = $query->num_rows();

			return json_decode(json_encode($result));
		}

		// failed... bounce.
		return array();
	}

	public function get_home_events($offset = 0)
	{
		// today's date
		$current_date = date('Y-m-d');
		$select = array(
			'posts.*', 'users.fullname'
			);
		
		// rediculous db call
		$this->db->select($select)
					->from('posts')
					->join('users', 'posts.author = users.users_id')
					->join('posts_to_categories', 'posts.id = posts_to_categories.post_id')
					->where('posts.status', 'published')
					->where('posts.date_posted <= ', $current_date)
					->where('posts_to_categories.category_id', 4)
					->order_by('posts.date_posted', 'DESC')
					->order_by('posts.id', 'DESC')
					->limit(3, $offset);
			
		$query = $this->db->get();
		
		// did we find anything?	
		if ($query->num_rows() > 0)
		{
			// yes...
			$result['posts'] = $query->result_array();

			// process for needed fields.
			foreach ($result['posts'] as &$item)
			{
				$item['url'] = events_url($item['url_title'], $item['date_posted']);
				$item['display_name'] = $item['fullname'];
				$item['categories'] = $this->catmodel->get_categories_by_ids($this->get_post_categories($item['id']));
				$item['date_posted'] = DateTime::createFromFormat('Y-m-d', $item['date_posted'])->format('F j');
			}

			$result['post_count'] = $query->num_rows();

			return json_decode(json_encode($result));
		}

		// failed... bounce.
		return array();
	}

	public function get_blogs($offset = 0)
	{
		// today's date
		$current_date = date('Y-m-d');
		$select = array(
			'posts.*', 'users.fullname'
			);
		
		// rediculous db call
		$this->db->select($select)
					->from('posts')
					->join('users', 'posts.author = users.users_id')
					->join('posts_to_categories', 'posts.id = posts_to_categories.post_id')
					->where('posts.status', 'published')
					->where('posts.date_posted <= ', $current_date)
					->where('posts_to_categories.category_id', 3)
					->order_by('posts.date_posted', 'DESC')
					->order_by('posts.id', 'DESC');
			
		$query = $this->db->get();
		
		// did we find anything?	
		if ($query->num_rows() > 0)
		{
			// yes...
			$result['posts'] = $query->result_array();

			// process for needed fields.
			foreach ($result['posts'] as &$item)
			{
				$item['url'] = post_url($item['url_title'], $item['date_posted']);
				$item['display_name'] = $item['fullname'];
				$item['categories'] = $this->catmodel->get_categories_by_ids($this->get_post_categories($item['id']));
				$item['date_posted'] = DateTime::createFromFormat('Y-m-d', $item['date_posted'])->format('D M d Y');
			}

			$result['post_count'] = $query->num_rows();

			return json_decode(json_encode($result));
		}

		// failed... bounce.
		return array();
	}

	public function get_news($offset = 0)
	{
		// today's date
		$current_date = date('Y-m-d');
		$select = array(
			'posts.*', 'users.fullname'
			);
		
		// rediculous db call
		$this->db->select($select)
					->from('posts')
					->join('users', 'posts.author = users.users_id')
					->join('posts_to_categories', 'posts.id = posts_to_categories.post_id')
					->where('posts.status', 'published')
					->where('posts.date_posted <= ', $current_date)
					->where('posts_to_categories.category_id', 5)
					->order_by('posts.date_posted', 'DESC')
					->order_by('posts.id', 'DESC');
			
		$query = $this->db->get();
		
		// did we find anything?	
		if ($query->num_rows() > 0)
		{
			// yes...
			$result['posts'] = $query->result_array();

			// process for needed fields.
			foreach ($result['posts'] as &$item)
			{
				$item['url'] = news_url($item['url_title'], $item['date_posted']);
				$item['display_name'] = $item['fullname'];
				$item['categories'] = $this->catmodel->get_categories_by_ids($this->get_post_categories($item['id']));
				$item['date_posted'] = DateTime::createFromFormat('Y-m-d', $item['date_posted'])->format('M d Y');
			}

			$result['post_count'] = $query->num_rows();

			return json_decode(json_encode($result));
		}

		// failed... bounce.
		return array();
	}

	public function get_news_details($url = NULL)
	{
		// load markdown lib
		$this->load->library('markdown');
		$select = array(
			'posts.*', 'users.fullname'
			);

		$this->db->select($select)
					->join('users', 'posts.author = users.users_id')
					->where('posts.status', 'published')
					->where('posts.url_title', $url);


		$this->db->limit(1);
			
		$query = $this->db->get('posts');
			
		if ($query->num_rows() == 1)
		{
			// yep
			$result = $query->row_array();

			// build the needed vaules
			$result['content'] = $this->markdown->parse($result['content']);
			$result['url'] = news_url($result['url_title']);
			$result['display_name'] = $result['fullname'];
			$result['categories'] = $this->catmodel->get_categories_by_ids($this->get_post_categories($result['id']));

			return $result;
		}
		return false;
	}

	public function get_blogs_details($url = NULL)
	{
		// load markdown lib
		$this->load->library('markdown');
		$select = array(
			'posts.*', 'users.fullname'
			);

		$this->db->select($select)
					->join('users', 'posts.author = users.users_id')
					->where('posts.status', 'published')
					->where('posts.url_title', $url);


		$this->db->limit(1);
			
		$query = $this->db->get('posts');
			
		if ($query->num_rows() == 1)
		{
			// yep
			$result = $query->row_array();

			// build the needed vaules
			$result['content'] = $this->markdown->parse($result['content']);
			$result['url'] = post_url($result['url_title']);
			$result['display_name'] = $result['fullname'];
			$result['categories'] = $this->catmodel->get_categories_by_ids($this->get_post_categories($result['id']));

			return $result;
		}
		return false;
	}

	public function get_event_details($url = NULL)
	{
		// load markdown lib
		$this->load->library('markdown');
		$select = array(
			'posts.*', 'users.fullname'
			);

		$this->db->select($select)
					->join('users', 'posts.author = users.users_id')
					->where('posts.status', 'published')
					->where('posts.url_title', $url);


		$this->db->limit(1);
			
		$query = $this->db->get('posts');
			
		if ($query->num_rows() == 1)
		{
			// yep
			$result = $query->row_array();

			// build the needed vaules
			$result['content'] = $this->markdown->parse($result['content']);
			$result['url'] = events_url($result['url_title']);
			$result['display_name'] = $result['fullname'];
			$result['categories'] = $this->catmodel->get_categories_by_ids($this->get_post_categories($result['id']));

			return $result;
		}
		return false;
	}

	public function get_post_categories($post_id)
	{
		$this->db->select('category_id');
		$this->db->where('post_id', $post_id);
		
		$query = $this->db->get('posts_to_categories');
			
		if ($query->num_rows() > 0)
		{
			$result = $query->result_array();
			
			foreach ($result as $category)
			{
				$categories[] = $category['category_id'];
			}
			
			return $categories;
		}
	}
}
