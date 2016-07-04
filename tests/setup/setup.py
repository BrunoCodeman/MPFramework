#coding: utf-8
#Script to install and configure PHPUnit and Composer with MAMP 
import os
import json
import platform
from getpass import getuser
from subprocess import check_output

bash_file = ""
user = getuser()
if 'Linux' in platform.system():
	bash_file = "/home/%s/.bash_rc" % user
else: 
	bash_file = "/Users/%s/.bash_profile" % user
bash_file_content = open(bash_file).read()

def setup():
	#configuration vars
	config = json.loads(open('config.json', 'r').read())
	
	#string vars
	path = config['PATH'].replace("${PHP_VERSION}", config['PHP_VERSION']).replace("$PATH",os.environ['PATH'])
	php_path = config['PHP_PATH'].replace("${PHP_VERSION}", config['PHP_VERSION'])
	navigate_command = "cd %s" % php_path
	
	#list vars
	env_vars = ['PHP_VERSION=%s' % config['PHP_VERSION'],
				"alias composer='php %s'" % config['COMPOSER_PATH'].replace("${PHP_VERSION}", config['PHP_VERSION']),
				"alias phpunit='php %s'" % config['PHPUNIT_PATH'].replace("${PHP_VERSION}", config['PHP_VERSION']),
				"export PATH=%s" % path]
	
	#dict vars
	commands = dict(composer="curl -sS %s > %s/composer.phar | php" % (config['COMPOSER_URL'], php_path), 
				phpunit="curl -sS %s > %s/phpunit.phar | php" % (config['PHPUNIT_URL'], php_path))
	
	phar_paths = dict(composer=config['COMPOSER_PATH'].replace("${PHP_VERSION}", config['PHP_VERSION']),
				  phpunit=config['PHPUNIT_PATH'].replace("${PHP_VERSION}", config['PHP_VERSION']))
	
	for env_var in env_vars:
		if not already_has_system_var(env_var):
			print('\n %s not in environment variables. Adding...' % env_var)
			add_env_variable(env_var)
		else:
			print('\n environment variable "%s" already created' % env_var)
	
	for name, file_path in phar_paths.items():
		if not is_installed(name, file_path):
			print('\n Executing %s at folder %s \n\n' %  (commands[name], navigate_command))
			execute_command("%s && %s" % (navigate_command, commands[name]))

	execute_command('source %s' % bash_file)
	print('setup complete!')

def add_env_variable(env_var):
	command = 'echo "\n%s" >> %s && source %s' % (env_var, bash_file, bash_file)
	print('\n Executing %s \n\n' % command)
	execute_command(command)	

def is_installed(dependency_name, dependency_path):
	already_installed = False
	try:
		print('\n Looking for %s installation in path %s' % (dependency_name, dependency_path))
		f = open(dependency_path, 'r')
		already_installed = f is not None
		print("%s is already installed. Skipping installation" % dependency_name)
	except Exception, e:
		print('%s not installed. Installing' % dependency_name)
	return already_installed

def already_has_system_var(system_var):
	return system_var in bash_file_content


def execute_command(command_text):
	return check_output(command_text, shell=True)


if __name__ == '__main__':
	if 'Windows' in platform.system():
		print('Sorry, only unix allowed. =/ ')
	setup()