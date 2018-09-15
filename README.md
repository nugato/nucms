<h3 align="center">
    <p>
        Master: 
        <a href="https://travis-ci.org/nugato/nucms" title="Build status" target="_blank">
            <img src="https://travis-ci.org/nugato/nucms.svg?branch=master" />
        </a>
        <br>
        Dev:
        <a href="https://travis-ci.org/nugato/nucms" title="Build status" target="_blank">
            <img src="https://travis-ci.org/nugato/nucms.svg?branch=develop" />
        </a>
    </p> 
</h1>

nucms
=====


Installation
=====
`bin/console doctrine:database:create`

`bin/console doctrine:migration:migrate`

`bin/console sylius:fixtures:load nucms`


Docker
=====
1. `cd docker`

2. `docker-compose build`

3. `docker-compose up -d`

4. Add host to "/etc/hosts" - `127.0.0.1 nucms.lc`

Production Domain: nucms.lc
Developer Domain: nucms.lc/app_dev.php