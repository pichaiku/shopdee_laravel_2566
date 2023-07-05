*** Settings ***
Library           SeleniumLibrary

Suite Setup       Open Browser    ${URL}    ${BROWSER}
Suite Teardown    Close Browser
Default Tags      customer_read

*** Variables ***
${URL}            http://127.0.0.1:8000/admin/customer
${BROWSER}        chrome

*** Test Cases ***
Valid Customer Read
    [Documentation]    Show all fields.
    [tags]             customer_read
    Maximize Browser Window 
    Click Link         xpath=//*[@id="table"]/tbody/tr[1]/td[5]/a
    Page Should Contain     รายละเอียดลูกค้า
    Sleep              2s
