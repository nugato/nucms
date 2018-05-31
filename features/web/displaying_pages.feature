@web_displaying_pages
Feature: Displaying page on frontend
    In order to present custom page on website
    As an visitor
    I want to be able to display single page

    Background:
        Given There are defined locales "en_US,pl_PL"

    @ui
    Scenario: Display single page in default locale
        Given There are defined page with slug "page-1" and locale "en_US"
        When I open this page
        Then I should see the title "Page-1"

    @ui
    Scenario: Display single page in second locale
        Given There are defined page with slug "page-1-pl" and locale "pl_PL"
        When I open this page
        Then I should see the title "Page-1-pl"
