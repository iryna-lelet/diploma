///<reference types="cypress" />

describe('Incoming record tests', () => {

    beforeEach('test', ()=>{
        cy.visit('localhost:8098/login')
        cy.get('#username').type('test@mail.com')
        cy.get('#password').type('12345678')
        cy.get('.login-form').submit()
    })

    function randomid(length) {
        var result = '';
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for ( var i = 0; i < length; i++ ) {
           result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }

    const dateObj = new Date();
    const month = String(dateObj.getMonth() + 1).padStart(2, '0');
    const day = String(dateObj.getDate()).padStart(2, '0');
    const year = dateObj.getFullYear();
    const todayDate = year  + '-' + month  + '-' + day;

    it('Create new record with all valid values', ()=>{
        var id=randomid(12)
        cy.visit('localhost:8098/incomings')
        cy.get('#addIncomingBtn').should('be.visible').click()
        cy.get('#date-picker').type(`${todayDate}`)
        cy.get('#incomings-merchant').type(id)
        cy.get('#incomings-amount').type('100')
        cy.get('#category-incomings').type('1')
        cy.get('#payment-type-incoming').type('1')
        cy.get('[test-id="save-incoming"]').should('be.visible').click()
        cy.get('[test-id="incoming-merchant"]').contains(id)
    })

    it('Delete record', ()=>{
        var id=randomid(12)
        cy.visit('localhost:8098/incomings')
        cy.get('#addIncomingBtn').click()
        cy.get('#date-picker').type(`${todayDate}`)
        cy.get('#incomings-merchant').type(id)
        cy.get('#incomings-amount').type('100')
        cy.get('#category-incomings').type('1')
        cy.get('#payment-type-incoming').type('1')
        cy.get('[test-id="save-incoming"]').click()
        cy.get('[test-id="incoming-merchant"]').contains(id).click()
        cy.get('#removeIncomingBtn').should('be.visible').click()
        cy.get('[test-id="incoming-merchant"]').contains(id).should('not.exist')
    })
})