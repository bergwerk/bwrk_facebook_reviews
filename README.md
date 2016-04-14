# Readme
## Usage
### 1. TypoScript-Configuration
Include and configure extension TypoScript.
> The best way for facebook access_token is to use a never expiring token.
> Have a look at: https://www.rocketmarketinginc.com/blog/get-never-expiring-facebook-page-access-token/

### 2. Configure Cron with CLI
> Configure a cronjob for Cli command: ./typo3/cli_dispatch.phpsh extbase import:run

This import command will import and the review database table.