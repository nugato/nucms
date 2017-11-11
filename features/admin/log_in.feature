@admin_ui
Feature: Log in to the admin dashboard
    In order to view admin dashboard
    As a visitor
    I want to be able to log in into admin dashboard

    @ui
    Scenario: Log in with valid email and password
        Given I want to log in
        Then I specify login data "admin" "password"
        And I log in
        Then I should be logged in
        And I should see welcome dashboard page
