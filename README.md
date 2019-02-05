# Oops/ContainerAdapter

[![Build Status](https://img.shields.io/travis/o2ps/ContainerAdapter.svg)](https://travis-ci.org/o2ps/ContainerAdapter)
[![Code Coverage](https://img.shields.io/codecov/c/github/o2ps/ContainerAdapter.svg)](https://codecov.io/gh/o2ps/ContainerAdapter)
[![Downloads this Month](https://img.shields.io/packagist/dm/oops/container-adapter.svg)](https://packagist.org/packages/oops/container-adapter)
[![Latest stable](https://img.shields.io/packagist/v/oops/container-adapter.svg)](https://packagist.org/packages/oops/container-adapter)

ContainerAdapter provides a PSR-11-compatible adapter of Nette's DI container. The adapter doesn't really like named services,
so it first assumes that the argument to `get()` or `has()` method is a type and tries to find a service of that type before
resorting to service name lookup.


## Installation and requirements

```bash
$ composer require oops/container-adapter
```

Oops/ContainerAdapter requires PHP >= 7.1.


## Usage

Register the extension in your config file:

```yaml
extensions:
	- Oops\ContainerAdapter\DI\ContainerAdapterExtension
```

The extension merely registers the adapter as a service.
