<?=form_open('user/validate')?>
<?=form_input('username', 'Username')?>
<?=form_password('password', 'Password')?>
<?=form_submit('submit', 'Login')?>
<?=anchor('user/signup', 'Create Account')?>
<?=form_close()?>