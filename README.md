# aws-env

Command-line script to obtain service configuration environment and secrets securely from AWS SSM.

## Configuration

Configuration can be provided via command line options or environment variables:

Option       | Env. Variable  | Description
-------------|----------------|---------------------------------------------------
-p, --path   | AWS_ENV_PATH   | Path of secrets to load from SSM
-f, --format | AWS_ENV_FORMAT | Output format, one of `dotenv`, `env`, or `export`

This script can find AWS credentials in the usual ways, including:

1. If running on EC2, by assuming an IAM role (recommended)
2. By reading the `~/.aws/config` and `~/.aws/credentials` files, with the optional `AWS_PROFILE` environment variable
3. Explicitly with the `AWS_REGION`, `AWS_ACCESS_KEY_ID` and `AWS_SECRET_ACCESS_KEY` environment variables

## Usage

```
Usage:
  aws-env [options]

Options:
  -p, --path=PATH       Parameter key path [default: "/"]
  -f, --format=FORMAT   Output format: dotenv, env, export [default: "env"]
  -h, --help            Display help for the given command. When no command is given display help for the bin/aws-env command
  -q, --quiet           Do not output any message
  -V, --version         Display this application version
      --ansi|--no-ansi  Force (or disable --no-ansi) ANSI output
  -n, --no-interaction  Do not ask any interactive question
  -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
```

For example, to start a shell with a new environment consisting only of the items pulled from AWS SSM + $PATH:

    env -i -S"$(bin/aws-env -p /my_app/development) PATH=$PATH" && /bin/bash

## License

MIT License
