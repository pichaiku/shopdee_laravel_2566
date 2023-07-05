*** Settings ***
Library           SeleniumLibrary

Suite Setup       Open Browser    ${URL}    ${BROWSER}
Suite Teardown    Close Browser
Default Tags      customer_create 

*** Variables ***
${URL}            http://127.0.0.1:8000/admin/customer
${BROWSER}        chrome

*** Test Cases ***
Valid Customer Create
    [Documentation]    All required fields are completed.
    [tags]             customer_create     smoke
    Maximize Browser Window
    Click Link         id=btnCreate
    Input Text         id=firstName     วิชัย
    Input Text         id=lastName      ใจซื่อ
    Input Text         id=username      wichai9
    Input Text         id=password      12345    
    Click Button       id=submit        
    Wait Until Element Is Visible   xpath=/html/body/div[2]/div/div[6]/button[1]
    Click Button        xpath=/html/body/div[2]/div/div[6]/button[1]

Invalid Customer Create with Some Blank Feilds
    [Documentation]    Some required fields are not completed.
    [Tags]             customer_create    
    Sleep              2s
    Click Link         id=btnCreate
    Input Text         id=firstName     ${EMPTY}
    Input Text         id=lastName      ${EMPTY}    
    Input Text         id=username      ${EMPTY}
    Input Text         id=password      ${EMPTY}    
    Click Button       id=submit        
    Wait Until Element Is Visible   id=invalid-firstName
    Wait Until Page Contains    กรุณาระบุชื่อ
    Wait Until Element Is Visible   id=invalid-lastName
    Wait Until Page Contains    กรุณาระบุนามสกุล
    Wait Until Element Is Visible   id=invalid-username
    Wait Until Page Contains    กรุณาระบุชื่อผู้ใช้
    Wait Until Element Is Visible   id=invalid-password
    Wait Until Page Contains    กรุณาระบุรหัผ่าน

Invalid Customer Create with Existing Username  
    [Documentation]    Username has been used
    [Tags]             customer_create    
    Sleep              2s
    Input Text         id=firstName     วิชัย
    Input Text         id=lastName      ใจซื่อ
    Input Text         id=username      wichai7
    Input Text         id=password      12345    
    Click Button       id=submit             
    Wait Until Element Is Visible   id=invalid-username
    Wait Until Page Contains    ชื่อผู้ใช้นี้มีอยู่แล้ว
    Sleep              2s