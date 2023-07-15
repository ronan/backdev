# Backdev

A devcontainer based local Backdrop CMS dev environment

Some of the values of this project:

- Create an identical environment on any workstation
- Require as few tools and custom scripts as possible
- Be as explicit as possible in all requirements
- Encourage config as code to prevent drift
- Cattle not pets
- Reproduce a production site quickly and automatically

## Prerequisites

This repository is designed to be used with Visual Studio Code and requires a container management and virtualization solution such as Docker Desktop

For more information on setting up your local environment see this tutorial:

https://code.visualstudio.com/docs/devcontainers/tutorial

## How to use

1. Prepare your workstation by following [this tutorial](https://code.visualstudio.com/docs/devcontainers/tutorial)

2. Clone this repository:

   >`git clone https://github.com/ronan/backdev`

3. Open it in VS Code:

   >`code backdev`

4. Build and Run the Dev Container

   VS Code you should prompt you to reopen the repository in a dev container. Or you can run the `Rebuild and Run in Container` command from the command palette.

5. Visit [http://localhost](http://localhost) in your browser.

### TODO

- [In Progress] Configure debugging tools correctly and include debugging instructions
- Add more Backdrop/Drupal-specific dev tooling, linting etc.
- Automatic production data sync with PII masking
- Auto-refreshing web previews for frontend development

### Note

This project is very early in development and structure can and will change. If you want to use this version you should fork or copy it because upstream merges won't be a priority until it is more stable and feature rich.
