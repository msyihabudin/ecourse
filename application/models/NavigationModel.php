<?php defined('BASEPATH') OR exit('No direct script access allowed');

class NavigationModel extends CI_Model
{
	// Protected or private properties
	protected $_table;
	
	public function __construct()
	{
		parent::__construct();
	}

	public function get_navs()
	{
		 return $this->db->get('navigation')->result();

	}

	public function get_nav($id)
	{
		return $this->db->where('id', $id)->limit(1)->get('navigation')->row_array();
	}

	public function get_nav_by_url($url)
	{
		return $this->db->where('url', $url)->limit(1)->get('navigation')->row_array();
	}

	public function add_nav($data)
	{	
		// for devlopers I've added the 
		// processing and form fields so
		// one could manually enter a URI
		// from the form.  By Default, this
		// functionality is not available.
		// See the Admin_navigation controller
		// for more information.
		
		// if the data['url'] has been passed, then
		// we set it to the entry, otherwise we set
		// it to an empty string.
		$data['url'] = (isset($data['url'])) ? $data['url'] : '';

		// if they've chosen an post's uri, then
		// we set data['uri'] to the post's uri
		if (! empty($data['post']))
		{
			$data['url'] = $data['post'];
		}
		// if they've chosen an page's uri, then
		// we set data['uri'] to the page's uri
		elseif (! empty($data['page']))
		{
			$data['url'] = 'page/' . $data['page'];
		}

		// unset what we don't need as this
		// array is what's built for the insert()	
		unset($data['post']);
		unset($data['page']);

		// add the extras...
		$data['external'] = '0';
		$data['position'] = $this->get_next_nav_position();

		// do the insert() and return insert result
		return $this->db->insert('navigation', $data);
	}

	public function update_nav($id, $data)
	{
		// get the current nav item
		$current = $this->get_nav($id);

		// default to not creating a new
		// redirect/building new slug...
		$new_slug = false;

		// get the redirect out of the update data
    	// this is only used if we're changing the 
    	// uri via page/post/manual entry
    	$redirect_val = $data['redirection'];
    	unset($data['redirection']);

    	// determine if we're setting a different 'url'
    	// and in the process setting a redirect...
    	// if the url isn't changing, we won't update that field
    	if (isset($data['url']) && $data['url'] != $current['url'])
    	{
    		$new_slug = true;
    	}
    	elseif (! empty($data['post']) && $data['post'] != $current['url'])
    	{
    		$new_slug = true;
    		$data['url'] = $data['post'];
    	}
    	elseif (! empty($data['page']) && $data['page'] != $current['url'])
    	{
    		$new_slug = true;
    		$data['url'] = 'page/' . $data['page'];
    	}

    	// determine if we're doing the new_slug/url_title thing
    	// and redirection...
    	if ($new_slug)
    	{
    		// determine what they want to do about the old
    		// slug and if we should redirect.
    		switch ($redirect_val) {
    			case 'none':
    				// they're don't want redirection... bounce
    				break;
    			case '301' || '302':
    				// set_redirect($old_slug, $new_slug, type=navs|nav, $code)
    				$this->set_redirect($current['url'], $data['url'], $data['type'], $redirect_val);
    				break;
    			default:
    				// set_redirect($old_slug, $new_slug, type=navs|nav, $code)
    				$this->set_redirect($current['url'], $data['url'], $data['type'], '301');
    				break;
    		}
    	}
    	

		// unset what we don't need as this
		// array is what's built for the update()
		unset($data['type']);
		unset($data['post']);
		unset($data['page']);

		// update the curent record and categories
		return $this->db->where('id', $id)->update('navigation', $data);
	}

	public function set_redirect($old_slug, $new_slug, $type='post', $code="301")
	{	
		// is the redirect already set?
		$current = $this->db
						->where('old_slug', $old_slug)
						->where('new_slug', $new_slug)
						->limit(1)
						->get('redirects')
						->row();

		// is there already a record?
		if ($current)
		{
			// we'll update code rather than insert a new record.
			// this is the only time one should be changing these
			// otherwise, delete and enter new information
			$update = [
				'code' => $code
			];
			return $this->db
						->where('id', $current->id)
						->update('redirects', $update);
		}

		// There's no records that appear for this one
		// so we'll insert the new redirects record.
		$insert = [
			'old_slug' 	=> $old_slug,
			'new_slug' 	=> $new_slug,
			'type'		=> $type,
			'code'		=> $code
		];
		return $this->db->insert('redirects', $insert);
	}
	
    public function remove_nav($id)
	{		
		return $this->db->delete('navigation', ['id' => $id]);
	}

	public function get_page_slugs()
	{
		// assign the slugs to the $options...
		$options = $this->db->select('title, url_title')->get('pages')->result();

		// there's a couple outside of normal possibilities in the db
		// so I add them here.
		$return[null] = 'Choose A Page';
		$return['pages/'] = 'Page Marked As Homepage';

		// foreach through them and add the url_title as key
		// and title as option text.
		foreach ($options as $opt)
		{
			$return[$opt->url_title] = $opt->title;

		}

		// return the obj
		return $return;
	}

	public function get_post_slugs()
	{
		// assign the slugs to the $options...
		$options = $this->db->select('date_posted, title, url_title')->get('posts')->result();

		// there's one outside of normal possibilities in the db
		// so I add it here.
		$return[null] = 'Choose A Blog Post';

		// foreach through them and add the url_title as key
		// and title as option text.
		foreach ($options as $opt)
		{
			$return[$opt->url_title] = $opt->title;

		}

		// return the obj
		return $return;
	}

	public function get_next_nav_position()
	{
		// get the last record
		$row = $this->db->order_by('position', 'DESC')->limit(1)->get('navigation')->row();

		// return that record position number +1
		return $row->position + 1;
	}


	/*
	
	AJAX STUFF

	 */
	
	public function update_nav_order($post_data)
	{
		// start with 0
		$i = 0;

		// foreach through each item 
		foreach ($post_data['item'] as $value) {

			// If we tried and failed to update the db
			// we fail so they can try again
			if ( ! $this->db->where('id', $value)->update('navigation', ['position' => $i]))
			{
				return false;
			}

			// iteration!
    		$i++;
		}

		// looks like everything went
		// well, return true.
		return true;
	}

	/*
	
	REDIRECT STUFF

	 */
	
    public function get_redirects()
	{
		return $this->db->get('redirects')->result();
	}

	public function get_redirect($id)
	{
		return $this->db->where('id', $id)->limit(1)->get('redirects')->row_array();
	}

	public function update_redirect($id, $data)
	{
		return $this->db->where('id', $id)->update('redirects', $data);
	}

	public function remove_redirect($id)
	{		
		return $this->db->delete('redirects', ['id' => $id]);
	}

}
