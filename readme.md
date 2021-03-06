# OpenDialog Core Package

[![CircleCI](https://circleci.com/gh/opendialogai/core/tree/master.svg?style=svg&circle-token=d14bcacaf3cd3e6ae4dfd2fb3bf03658cf0ca8fa)](https://circleci.com/gh/opendialogai/core/tree/master)

This is the OpenDialog core package that can be used inside of your conversational application.

[OpenDialog](https://opendialog.ai) is a conversation management platform and OpenDialog Core provides the 
key pieces of support required. It has been created by the conversational interface and applied AI team at [GreenShoot Labs](https://www.greenshootlabs.com/).

We will soon be releasing our webchat package that gives you a webchat interface as well as a full Laravel-based
application that makes use of OpenDialog core and provides a GUI to manage conversations. 

In the meantime if you would like a preview please [get in touch](https://www.greenshootlabs.com/).

## Installing

Install in composer with the following block:

```"opendialogai/core"```

## Local Config
To publish config files for local set up and customisation, run

```php artisan vendor:publish --tag="config"```

This will copy over all required config files into `config/opendialog/`

## Running Code Sniffer

To run code sniffer, run the following command
```./vendor/bin/phpcs --standard=od-cs-ruleset.xml src/ --ignore=*/migrations/*,*/tests/*```

This will ignore all files inside of migration directories as they will never have a namespace

## Git Hooks

To set up the included git pre-commit hook, first make sure the pre-commit script is executable by running

```chmod +x .githooks/pre-commit```

Then configure your local git to use this directory for git hooks by running:

```git config core.hooksPath .githooks/```

Now every commit you make will trigger php codesniffer to run. If there is a problem with the formatting
of the code, the script will echo the output of php codesniffer. If there are no issues, the commit will
go into git.

## Running Tests

```./vendor/bin/phpunit```

## DGraph

You may find instructions to setup a development instance of DGraph in dgraph/dgraph-setup.md

You will need to set the DGraph URL and port in your .env file, e.g.:

```
DGRAPH_URL=http://10.0.2.2
DGRAPH_PORT=8080
```

### Query Logging

To log DGraph queries to the standard application log, set the `LOG_DGRAPH_QUERIES` environment variable to true.
All queries are logged at info level

## Logging API requests

By default, all incoming and outgoing API calls will be logged to the request and response mysql tables.
To prevent this happening, set the `LOG_API_REQUESTS` env variable to `false`