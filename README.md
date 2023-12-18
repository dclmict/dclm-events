<p align="center"><a href="https://dclm.org" target="_blank"><img src="https://dclmcloud.s3.amazonaws.com/img/logo.png" width="206.5" height="190"></a></p>

## DCLM Events
This is an events management app that 

App url: [DCLM Events](https://events.dclm.org)


## How to Run
### Docker
- make sure you have [make](docs/make.md) installed
- make sure you have [Docker](https://docs.docker.com/desktop/) installed
- make sure you have [docker compose](https://docs.docker.com/compose/install/) installed
- make sure you have [docker compose](https://docs.docker.com/compose/install/) installed
- create app directory: `mkdir -p <directory-name>`
- run `git clone https://github.com/dclmict/dclm-events.git .`
- run `make run` (wait for like 2mins for the container to boot and load properly)
- run `make key`
- run `make migrate`
- run `make seed`
- run `make storage`
- run `make log`


## Credit
App built and released by [DCLM Tech Community (DTC)](https://developers.dclm.org).
