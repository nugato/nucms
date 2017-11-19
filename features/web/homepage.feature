@web
Feature: View homepage
    In order to view the homepage
    As a visitor
    I want to be able to see homepage

    Background:
        Given There are defined locales "en,pl"

    @ui
    Scenario: See the homepage
        Given I am on the homepage
        Then I should see "Hello"

    @ui
    Scenario: See the homepage for specified locale
        Given I am on the homepage for specific locale "pl"
        Then I should see "Hello"
