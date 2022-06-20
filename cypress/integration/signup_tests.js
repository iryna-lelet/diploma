///<reference types="cypress" />

describe('Signup tests', () => {
    function makeid(length) {
        var result           = '';
        var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for ( var i = 0; i < length; i++ ) {
           result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
     }

    it('Signup with valid data', ()=>{
        cy.visit('localhost:8098/signup')
        cy.get('#signupEmail').type(makeid(8) + "@mail.com")
        cy.get('#signupUsername').type('TestUser')
        cy.get('#password').type('12345678')
        cy.get('.signup-form').submit()
        cy.get('[data-test-id=created-user-alert]').should('be.visible')
        cy.get('[data-test-id=created-user-alert]').contains('New user has been successfully created')
    })

    it('Signup with valid data', ()=>{
        cy.visit('localhost:8098/signup')
        cy.get('#signupEmail').type(makeid(8) + "@mail.com")
        cy.get('#signupUsername').type('TestUser')
        cy.get('#password').type('12345678')
        cy.get('.signup-form').submit()
        cy.get('[data-test-id=created-user-alert]').should('be.visible')
        cy.get('[data-test-id=created-user-alert]').contains('New user has been successfully created')
    })

    it('Signup with email that is already used', ()=>{
        cy.visit('localhost:8098/signup')
        cy.get('#signupEmail').type('test@mail.com')
        cy.get('#signupUsername').type('TestUser')
        cy.get('#password').type('12345678')
        cy.get('.signup-form').submit()
        cy.get('[data-test-id=wrong-mail]').should('be.visible')
        cy.get('[data-test-id=wrong-mail]').contains('The email has already been taken')
    })

    it('Signup with too small password', ()=>{
        cy.visit('localhost:8098/signup')
        cy.get('#signupEmail').type(makeid(8) + "@mail.com")
        cy.get('#signupUsername').type('TestUser')
        cy.get('#password').type('1234567')
        cy.get('.signup-form').submit()
        cy.get('[data-test-id=wrong-password]').should('be.visible')
        cy.get('[data-test-id=wrong-password]').contains('The password must be at least 8 characters')
    })

    it('Signup with too big password', ()=>{
        cy.visit('localhost:8098/signup')
        cy.get('#signupEmail').type(makeid(8) + "@mail.com")
        cy.get('#signupUsername').type('TestUser')
        cy.get('#password').type('12345678912345678')
        cy.get('.signup-form').submit()
        cy.get('[data-test-id=wrong-password]').should('be.visible')
        cy.get('[data-test-id=wrong-password]').contains('The password must not be greater than 16 characters')
    })

    it('Signup with invalid email', ()=>{
        cy.visit('localhost:8098/signup')
        cy.get('#signupEmail').type(makeid(8) + "mail.com")
        cy.get('#signupUsername').type('TestUser')
        cy.get('#password').type('123456789')
        cy.get('.signup-form').submit()
        cy.get('[data-test-id=wrong-mail]').should('be.visible')
        cy.get('[data-test-id=wrong-mail]').contains('The email must be a valid email address. ')
    })

    it('Signup with empty email', ()=>{
        cy.visit('localhost:8098/signup')
        cy.get('#signupUsername').type('TestUser')
        cy.get('#password').type('123456789')
        cy.get('.signup-form').submit()
        cy.get('[data-test-id=wrong-mail]').should('be.visible')
        cy.get('[data-test-id=wrong-mail]').contains('The email field is required. ')
    })

    it('Signup with empty username', ()=>{
        cy.visit('localhost:8098/signup')
        cy.get('#signupEmail').type(makeid(8) + "@mail.com")
        cy.get('#password').type('123456789')
        cy.get('.signup-form').submit()
        cy.get('[data-test-id=wrong-username]').should('be.visible')
        cy.get('[data-test-id=wrong-username]').contains('The name field is required. ')
    })

    it('Signup with empty password', ()=>{
        cy.visit('localhost:8098/signup')
        cy.get('#signupEmail').type(makeid(8) + "@mail.com")
        cy.get('#signupUsername').type('TestUser')
        cy.get('.signup-form').submit()
        cy.get('[data-test-id=wrong-password]').should('be.visible')
        cy.get('[data-test-id=wrong-password]').contains('The password field is required. ')
    })
})