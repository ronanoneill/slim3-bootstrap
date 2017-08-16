Slim 3 Bootstrap
==========

Based on the [Slim 3](http://www.slimframework.com/) framework ([documentation here](http://www.slimframework.com/docs/)). It uses the [Twig](http://twig.sensiolabs.org/) ([documentation here](http://twig.sensiolabs.org/documentation)) templating engine loaded via Slim's [Twig-View](http://www.slimframework.com/docs/features/templates.html#the-slimtwig-view-component) component, [Less CSS](http://lesscss.org/) as a CSS pre-processor, [Grunt](http://gruntjs.com/) as a JS taskrunner for dev task automation and [PHP Unit](https://phpunit.de/) to facilitate unit testing.

## Autoloading

Uses Composer's [PSR-4](http://www.php-fig.org/psr/psr-4/#2-specification) autoloader. Adding a new class within an existing namespace makes it automatically available. To register a new namespace you need to update the autoload section of `composer.json` with the new namespace and its path:

```
"autoload": {
    "psr-4": {
        "Bootstrap\\": "app/src",
    }
}
```

## Coding standards

All code contained within this repo should conform to the [PSR-2 standards](http://www.php-fig.org/psr/psr-2/).

## Running the Docker development environment

1. Install Docker on your local machine: https://docs.docker.com/engine/installation/

2. Clone this repo locally

3. You can startup the project and install the dependencies via docker-compose:

    Build and run the containers in detached mode using docker-compose:

    `docker-compose up -d`

    Install the composer packages by running Composer in the `php` service container:

    `docker-compose run --rm php composer install`

    Install NPM packages by running NPM in the `nodejs` service containter:

    `docker-compose run --rm --no-deps nodejs sh -c "npm install --silent"`

    Launch Grunt Watch (defined in gruntfile.js) by running Grunt in the `nodejs` service container:

    `docker-compose run --rm --no-deps nodejs sh -c "grunt"`

    You can stop and remove any container by running:

    ```
    docker stop <container name>
    docker rm <container name>
    ```

You should now be able to access the Bootstrap platform by browsing to localhost on **port 3000**. Any changes made to the code will be shared automatically to the docker container.
