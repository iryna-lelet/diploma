///<reference types="cypress" />

describe('Signup tests', () => {

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

    const types = ['Доход', 'Расход' ];
    var item = types[Math.floor(Math.random() * types.length)];

    it('Add category', ()=>{
        var id=randomid(12)
        cy.visit('localhost:8098/settings')
        cy.get('#addCategoryBtn').should('be.visible').click()
        cy.get('#name-category').type(id)
        cy.get('#type-category').select(item)
        cy.get('[test-id="category-save').should('be.visible').contains('Сохранить').click()
        cy.get('[test-id="grid-category-name"]').contains(id)
        cy.get('[test-id="grid-category-type"]').contains(item)
        cy.get('[test-id="success-alert"]').should('be.visible').contains(`Created category ${id}`)
    })

    it('Remove category', ()=>{
        var id=randomid(12)
        cy.visit('localhost:8098/settings')
        cy.get('#addCategoryBtn').click()
        cy.get('#name-category').type(id)
        cy.get('#type-category').select(item)
        cy.get('[test-id="category-save"]').click()
        cy.get('[test-id="grid-category-name"]').contains(id).click()
        cy.get('#removeCategoryBtn').should('be.visible').contains('удалить').click()
        cy.get('[test-id="grid-category-name"]').contains(id).should('not.exist')
        cy.get('[test-id="remove-alert"]').should('be.visible').contains('Selected categories are deleted')
    })

    it('Add payment', ()=>{
        var id=randomid(12)
        var notes = randomid(25)
        cy.visit('localhost:8098/settings')
        cy.get('#addPaymentBtn').should('be.visible').click()
        cy.get('#payment-name').type(id)
        cy.get('#payment-notes').type(notes)
        cy.get('[test-id="payment-save"]').should('be.visible').contains('Сохранить').click()
        cy.get('[test-id="grid-payment-name"]').contains(id)
        cy.get('[test-id="grid-payment-notes"]').contains(notes)
        cy.get('[test-id="success-alert"]').should('be.visible').contains(`Created payment method ${id}`)
    })

    it('Remove payment', ()=>{
        var id=randomid(12)
        cy.visit('localhost:8098/settings')
        cy.get('#addPaymentBtn').click()
        cy.get('#payment-name').type(id)
        cy.get('#payment-notes').type(randomid(20))
        cy.get('[test-id="payment-save"]').click()
        cy.get('[test-id="grid-payment-name"]').contains(id).click()
        cy.get('#removePaymentBtn').should('be.visible').contains('удалить').click()
        cy.get('[test-id="grid-payment-name"]').contains(id).should('not.exist')
        cy.get('[test-id="remove-alert"]').should('be.visible').contains('Selected payment methods are deleted')
    })

    it('Add currency', ()=>{
        var id=randomid(12)
        var symbol = randomid(1)
        cy.visit('localhost:8098/settings')
        cy.get('#addCurrencyBtn').should('be.visible').click()
        cy.get('#currency-name').type(id)
        cy.get('#currency-symbol').type(symbol)
        cy.get('[test-id="currency-save"]').should('be.visible').contains('Сохранить').click()
        cy.get('[test-id="grid-currency-name"]').contains(id)
        cy.get('[test-id="grid-currency-symbol"]').contains(symbol)
        cy.get('[test-id="success-alert"]').should('be.visible').contains(`Created currency ${id}`)
    })

    it('Remove currency', ()=>{
        var id=randomid(12)
        cy.visit('localhost:8098/settings')
        cy.get('#addCurrencyBtn').click()
        cy.get('#currency-name').type(id)
        cy.get('#currency-symbol').type(randomid(1))
        cy.get('[test-id="currency-save"]').click()
        cy.get('[test-id="grid-currency-name"]').contains(id).click()
        cy.get('#removeCurrencyBtn').should('be.visible').contains('удалить').click()
        cy.get('[test-id="grid-currency-name"]').contains(id).should('not.exist')
        cy.get('[test-id="remove-alert"]').should('be.visible').contains('Selected currencies are deleted')
    })
})