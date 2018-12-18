from tools.fablib import *

from fabric.api import task


"""
Base configuration
"""
env.project_name = 'publicsource'       # name for the project.
env.hosts = ['localhost', ]
env.sftp_deploy = True
env.domain = 'publicsource.test'

"""
Add HipChat info to send a message to a room when new code has been deployed.
"""
env.hipchat_token = ''
env.hipchat_room_id = ''


# Environments
@task
def production():
    """
    Work on production environment
    """
    env.settings    = 'production'
    env.hosts       = [ os.environ['PUBLICSOURCE_PRODUCTION_SFTP_HOST'], ]    # ssh host for production.
    env.path        = os.environ['PUBLICSOURCE_PRODUCTION_SFTP_PATH']
    env.user        = os.environ['FLYWHEEL_SFTP_USER']    # ssh user for production.
    env.password    = os.environ['FLYWHEEL_SFTP_PASS']    # ssh password for production.
    env.domain      = 'publicsource.org'
    env.port        = 22


@task
def staging():
    """
    Work on staging environment
    """
    env.settings    = 'staging'
    env.hosts       = [ os.environ['PUBLICSOURCE_STAGING_SFTP_HOST'], ]    # ssh host for staging.
    env.path        = os.environ['PUBLICSOURCE_STAGING_SFTP_PATH']
    env.user        = os.environ['FLYWHEEL_SFTP_USER']    # ssh user for staging.
    env.password    = os.environ['FLYWHEEL_SFTP_PASS']    # ssh password for staging.
    env.domain      = 'staging.classy-vegetable.flywheelsites.com'
    env.port        = 22

try:
    from local_fabfile import  *
except ImportError:
    pass
