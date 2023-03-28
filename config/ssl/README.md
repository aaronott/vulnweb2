To generate a valid TLS certificate for the domain coolsite.local, we will use the mkcert tool. Here are the steps to follow:

Install mkcert by following the instructions here: https://github.com/FiloSottile/mkcert#installation
Run mkcert coolsite.local to generate a certificate and key file for the domain.
Copy the generated coolsite.local.pem and coolsite.local-key.pem files to the ./certs directory.
Update your local hosts file to map the domain coolsite.local to 127.0.0.1. On Linux or macOS, you can edit /etc/hosts and add a line like this: 127.0.0.1 coolsite.local.
Run docker-compose up -d to start the containers.
You should now be able to access the website securely at https://coolsite.local and connect to the database from within the website container using the environment variables specified in the .env file.
