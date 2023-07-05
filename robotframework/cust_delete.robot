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
    [Documentation]    Delete customer where id = 9.
    [tags]             customer_read
    Maximize Browser Window 
    Click Button                    id=btnDelete9
    Wait Until Page Contains        คุณต้องการลบข้อมูลรายการนี้ใช่หรือไม่?    
    Wait Until Element Is Visible   class=swal2-confirm
    Click Button                    class=swal2-confirm
    Click Button                    xpath=/html/body/div[2]/div/div[6]/button[1]
    