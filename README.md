# lumen-laravel-socket-server

## Dependencies

* PHP 7.0+
* Redis

```
npm install -g laravel-echo-server
composer install
```

In development you need to configure the server with
`laravel-echo-server init` and can then use your configured `.env`
variables within your Lumen / Laravel app

Start echo server with `laravel-echo-server start` - this will
listen on whichever port you specify in your config.

This works hand-in-hand with your Lumen / Laravel project, and listens
for events from it.

The reason it's made in Laravel and not Lumen is because it needs state.

# Example Conf Files for Production

There are example files for running the sockets through nginx which is
used in production.

There is an example configuration for SSL websockets on the laravel-echo-server.

There is a sample Supervisor configuration file for keeping the socket
server running.

# Certificates

If you want to run with SSL you need to generate letsencrypt certificates
using the `certbot certonly` command and include the location of the
certificates in the config files.

# Important

Queues must be running in your Laravel / Lumen app and *your app must
be using Redis as the queue _and_ the broadcaster*

The Laravel / Lumen variables `PUSHER_APP_KEY` and `PUSHER_APP_ID` correspond
to whichever values you set in your instance of the laravel echo server.

Socket Server and your Lumen / Laravel app do not have to be on the same physical
machine. As long as they both use the same Redis server it will all work.
