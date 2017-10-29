@web_ui
Feature: View homepage
    In order to view the homepage
    As a visitor
    I want to be able to see homepage

    @ui
    Scenario: See the homepage
        Given I am on the homepage
        Then I should see "Hello"