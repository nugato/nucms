@admin_managing_pages
Feature: Managing pages in admin dashboard
    In order to present custom pages in website
    As an administrator
    I want to be able to create/update/edit pages

    Background:
        Given There are defined locales "en,pl"
        And I am login as "admin@nucms.com" identified by "password"

    @ui
    Scenario:
        Given I want to create a page
        When I specify its title with "Super page"
        And I specify its content with "Some example description"
        And I create it
        Then I should be notified that it has been successfully created
        And slug should be equals "super-page"
