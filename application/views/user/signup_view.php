<?=form_open('user/create')?>
<?=form_input('username', set_value('username', 'Username'))?>
<?=form_input('email', set_value('email', 'Email Address'))?>
<?=form_password('password', set_value('password', 'Password'))?>
<?=form_password('password2', set_value('password2', 'Confirm Password'))?>
<?=form_submit('submit', 'Signup!')?>
<?=form_close()?>

<?=validation_errors('<p class="error">')?>
