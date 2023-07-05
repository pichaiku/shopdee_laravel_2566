*** Settings ***
Library           SeleniumLibrary

Suite Setup       Open Browser    ${URL}    ${BROWSER}
Suite Teardown    Close Browser
Default Tags      customer_update 

*** Variables ***
${URL}            http://127.0.0.1:8000/admin/customer
${BROWSER}        chrome

*** Test Cases ***
Valid Customer Update
    [Documentation]    All required fields are completed.
    [tags]             customer_update     smoke
    Maximize Browser Window
    Click Link         xpath=//*[@id="table"]/tbody/tr[1]/td[6]/a
    Input Text         id=firstName     วิชาติชาญ
    Input Text         id=lastName      ใจซื่อสัตย์
    Input Text         id=username      somchai2
    Input Text         id=password      1234567    
    Click Button       id=submit        
    Wait Until Element Is Visible   xpath=/html/body/div[2]/div/div[6]/button[1]
    Click Button        xpath=/html/body/div[2]/div/div[6]/button[1]

Invalid Customer Update with Some Blank Feilds
    [Documentation]    Some required fields are not completed.
    [Tags]             customer_update    
    Sleep              2s
    Click Link         xpath=//*[@id="table"]/tbody/tr[1]/td[6]/a
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

Invalid Customer Update with Existing Username  
    [Documentation]    Username has been used
    [Tags]             customer_update    
    Sleep              2s    
    Input Text         id=firstName     วิชาติชาญ
    Input Text         id=lastName      ใจซื่อสัตย์
    Input Text         id=username      user1
    Input Text         id=password      1234567   
    Click Button       id=submit            
    Wait Until Element Is Visible   id=invalid-username
    Wait Until Page Contains    ชื่อผู้ใช้นี้มีอยู่แล้ว
    Sleep              2s