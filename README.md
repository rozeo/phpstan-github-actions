# phpstan-github-actions
PHPStan support for Github Pull Request On Github Actions
----

### Setup
1. add dependecy in composer.json
```
"rozeo/phpstan-github-actions": "^1.0.0"
```
2. put `phpstan.neon` setting file to repository root.
```
touch phpstan.neon
```
3. setting phpstan and add phpstan custom formatter.
ex.)
```neon
parameters:
	level: 5
	paths:
		- src

services:
    errorFormatter.markdown:
    	class: Rozeo\PHPStanAction\PHPStanMarkdownFormatter
```
4. add rules on workflow file(based php workflow).
```
on:
  pull_request:
    branches:
      - branch
~~~
- name: composer install
  run: composer install
  
- name: running phpstan
  env:
    GITHUB_TOKEN: ${{ secrets.GITHUB_TOKEN }}
    GITHUB_URL: ${{ github.event.pull_request.comments_url }}
    GITHUB_SHA: ${{ github.sha }}
    GITHUB_REPOSITORY: ${{ github.repository }}
  run: ./bin/phpstan-github-actions
```
