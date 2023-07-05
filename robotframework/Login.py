*** Settings ***
Library           SeleniumLibrary

Suite Setup       Open Browser    ${URL}    ${BROWSER}
Suite Teardown    Close Browser

*** Variables ***
${URL}            https://example.com/signup
${BROWSER}        chrome

*** Test Cases ***
Successful Sign-Up Test
    [Documentation]    Tests successful sign-up functionality
    [Tags]             sign-up, smoke
    Input Text         id=first-name     John
    Input Text         id=last-name      Doe
    Input Text         id=email          john.doe@example.com
    Input Text         id=password       Pa$$w0rd
    Input Text         id=confirm-password  Pa$$w0rd
    Click Button       id=submit-button
    Wait Until Element Is Visible    id=success-message
    Element Should Contain    id=success-message    You have successfully signed up!

Invalid Email Test
    [Documentation]    Tests error message when an invalid email is entered
    [Tags]             sign-up, regression
    Input Text         id=first-name     Jane
    Input Text         id=last-name      Smith
    Input Text         id=email          jane.smith@invalid
    Input Text         id=password       Pa$$w0rd
    Input Text         id=confirm-password  Pa$$w0rd
    Click Button       id=submit-button
    Wait Until Element Is Visible    id=email-error
    Element Should Contain    id=email-error    Please enter a valid email address.

Password Mismatch Test
    [Documentation]    Tests error message when password and confirm password fields do not match
    [Tags]             sign-up, regression
    Input Text         id=first-name     Bob
    Input Text         id=last-name      Johnson
    Input Text         id=email          bob.johnson@example.com
    Input Text         id=password       Pa$$w0rd
    Input Text         id=confirm-password  wrongpassword
    Click Button       id=submit-button
    Wait Until Element Is Visible    id=password-error
    Element Should Contain    id=password-error    Passwords do not match. Please try again.
