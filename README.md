# Demonstration of PostLoad events not being triggered when retrieving objects by reference

## Usage

This application requires an executable file `bin/php` loads the correct PHP binary.

First, install dependencies and create a new database with the correct schema (will create an SQLite database in ./tmp)

```bash
composer install

bin/doctrine orm:schema-tool:create
```

Create an Entity and load it normally

```bash
bin/create-new-entity # assume it creates an entity with id 1
bin/load-entity 1 # Output should contain: PostLoad EventListener called for Entity\Test#1
```

Load the same entity by reference and access a property to trigger initialisation

```bash
bin/load-entity-by-reference-and-access-proprty 1 # Output will NOT contain: PostLoad EventListener called
```

## Explanation

When loading entities by first retrieving a reference and then letting it initialise, Doctrine does not trigger PostLoad
events. This happens neither if Doctrine implements the reference as a Proxy (Doctrine < 4.0 default behaviour) ~~nor if
it uses a "ghost object" (EntityManager created with `$config->enableNativeLazyObjects(true);`, PHP >=8.4)~~ this has not
been tested yet.

If you depend on the PostLoad event to perform some initialisation logic (e.g. loading binary data into properties),
this can lead to incomplete entity objects being used.
