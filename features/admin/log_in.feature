@admin
    Feature: Log in to the admin dashboard
    In order to view admin dashboard
    As a visitor
    I want to be able to log in into admin dashboard

    Background:
        Given There are defined locales "en_US,pl_PL"

    @ui
    Scenario: Log in with valid email and password
        Given There is an administrator user "admin@nucms.com" identified by "password"
        And I want to log in
        When I specify login data "admin@nucms.com" "password"
        And I log in
        Then I should be logged in

    @ui
    Scenario: Log in with invalid email and password
        Given I want to log in
        When I specify login data "wrong@nucms.com" "wrong"
        And I log in
        Then I should not be logged in
        And I should see error message
