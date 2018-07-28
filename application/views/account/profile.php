<main class="account">
    <div class="ui text container">
        <h2>Profile</h2>
        <div class="ui container">
            <div class="ui segments">
                <div class="ui padded segment">
                    <?= form_open_multipart('account/change_photo', 'class="ui form"'); ?>
                        <?= form_hidden('id_user', $account['id_user']); ?>
                        <div class="fields">
                            <div class="field">
                                <img class="ui tiny circular image" src="<?= $account['photo_url']; ?>" />
                            </div>
                            <div class="field">
                                <?= form_upload('url', ''); ?>
                            </div>
                            <div class="field">
                                <?= form_submit('change_photo', 'Change Photo', 'class="ui primary button"'); ?>
                            </div>
                        </div>
                    <?= form_close(); ?>
                </div>
                <div class="ui padded segment">
                    <?= form_open('account/save_account', 'class="ui form"'); ?>
                        <div class="ui error message"></div>
                        <?= form_hidden('id_user', $account['id_user']); ?>
                        <div class="required field">
                            <label>Name</label>
                            <?= form_input('name', $account['name'], array('placeholder'=>'Name', 'required'=>'')); ?>
                        </div>
                        <div class="required field">
                            <label>Email</label>
                            <?= form_input(array('type'=> 'email', 'name'=>'email'), $account['email'], array('placeholder'=>'Email', 'required'=>'')); ?>
                        </div>
                        <div class="required field">
                            <label>Username</label>
                            <?= form_input('username', $account['username'], array('placeholder'=>'Username', 'required'=>'')); ?>
                        </div>
                        <?= form_submit('save_account', 'Save Change', 'class="ui large fluid primary button"'); ?>
                    <?= form_close(); ?>
                </div>
                <div class="ui padded segment">
                    <?= form_open('account/change_password', 'class="ui form"'); ?>
                        <div class="ui error message"></div>
                        <?= form_hidden('id_user', $account['id_user']); ?>
                        <div class="required field">
                            <label>Current Password</label>
                            <?= form_password('current_password', '', array('placeholder'=>'Current Password', 'required'=>'')); ?>
                        </div>
                        <div class="required field">
                            <label>New Password</label>
                            <?= form_password('new_password', '', array('placeholder'=>'New Password', 'required'=>'')); ?>
                        </div>
                        <?= form_submit('change_password', 'Change Password', 'class="ui large fluid primary button"'); ?>
                    <?= form_close(); ?>
                </div>
            </div>

            <div class="ui segments">
                <div class="ui red inverted padded segment">
                    <i class="info icon"></i>Delete Account
                </div>
                <div class="ui padded segment">
                    <ul class="list">
                        <li class="item">You will immediately lose access to your transaction history, course activity, and all other information associated with your account.</li>
                        <li class="item">This cannot be undone.</li>
                    </ul>
                    <br />

                    <?= form_open('account/delete_account', 'class="ui form"'); ?>
                        <div class="ui error message"></div>
                        <?= form_hidden('id_user', $account['id_user']); ?>
                        <div class="required field">
                            <label>Current Password To Delete Account</label>
                            <?= form_password('current_password', '', array('placeholder'=>'Current Password', 'required'=>'')); ?>
                        </div>
                        <?= form_submit('delete_account', 'Delete Account', 'class="ui large fluid red button"'); ?>
                    <?= form_close(); ?>
                </div>
            </div>

        </div>
    </div>
</main>