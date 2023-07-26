# aws-env

Command-line script to obtain service configuration environment and secrets securely from AWS SSM.

## Configuration

Configuration can be provided via command line options or environment variables:

Option       | Env. Variable  | Description
-------------|----------------|-------------------------------------------------
-p, --path   | AWS_ENV_PATH   | Path of secrets to load from SSM
-f, --format | AWS_ENV_FORMAT | Output format, one of `env`, `exec`, or `dotenv`

In addition, the AWS region must be provided via one of the following environment variables:

* AWS_REGION
* AWS_DEFAULT_REGION

AWS credentials can be provided one of the following ways:

1. If running on EC2, by assuming an IAM role (recommended)
2. Read from the ~/.aws/configuration file, with the optional `AWS_PROFILE` environment variable
3. Explicitly with the `AWS_ACCESS_KEY_ID`, `AWS_SECRET_ACCESS_KEY`, and optional `AWS_SESSION_TOKEN` environment variables

For a list of all supported environment variables and authentication options, see https://docs.aws.amazon.com/sdkref/latest/guide/settings-reference.html#EVarSettings.

## Usage

```
Usage:
  aws-env [options]

Options:
  -p, --path=PATH       Parameter key path [default: "/"]
  -f, --format=FORMAT   Output format: dotenv,export [default: "exec"]
  -h, --help            Display help for the given command. When no command is given display help for the bin/aws-env command
  -q, --quiet           Do not output any message
  -V, --version         Display this application version
      --ansi|--no-ansi  Force (or disable --no-ansi) ANSI output
  -n, --no-interaction  Do not ask any interactive question
  -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
```

Example:

    # have these set in your environment already
    export AWS_PROFILE=default
    export AWS_REGION=us-east-1
    export AWS_ENV_PATH=/my_app/development
    export AWS_ENV_FORMAT=env
    
    # start a shell with a new environment consisting only of the items pulled from AWS SSM + $PATH
    env -i -S"$(bin/aws-env) PATH=$PATH" && /bin/bash

## License

MIT License
