///<reference types="cypress" />


describe('Login tests', () => {
  it('Login with valid data', () => {
    cy.visit('localhost:8098/login')
    cy.get('#username').type('test@mail.com')
    cy.get('#password').type('12345678')
    cy.get('.login-form').submit()
    cy.url().should('include', '/')
    cy.get('.main-content').contains('Hello')
  })

  it('Show error alert when login with email of non-existed user', ()=>{
    cy.visit('localhost:8098')
    cy.get('#username').type('non-existed@mail.com')
    cy.get('#password').type('12345678')
    cy.get('.login-form').submit()
    cy.get('[data-test-id=error-alert]').should('be.visible')
    cy.get('[data-test-id=error-alert]').contains('Sorry, we do not recognize you')
  })

  it('Show error alert when login with incorrect password', ()=>{
    cy.visit('localhost:8098')
    cy.get('#username').type('test@mail.com')
    cy.get('#password').type('10101010101')
    cy.get('.login-form').submit()
    cy.get('[data-test-id=error-alert]').should('be.visible')
    cy.get('[data-test-id=error-alert]').contains('Incorrect password')
})

  it('Show error message when login with invalid email', ()=>{
    cy.visit('localhost:8098')
    cy.get('#username').type('testmail.com')
    cy.get('#password').type('12345678')
    cy.get('.login-form').submit()
    cy.get('[data-test-id=invalid-email-message]').should('be.visible')
    cy.get('[data-test-id=invalid-email-message]').contains('The email must be a valid email address')
  })

  it('Show error message when login with too short password', ()=>{
    cy.visit('localhost:8098')
    cy.get('#username').type('test@mail.com')
    cy.get('#password').type('12345')
    cy.get('.login-form').submit()
    cy.get('[data-test-id=wrong-password]').should('be.visible')
    cy.get('[data-test-id=wrong-password]').contains('The password must be at least 8 characters')
  })

  it('Show error message when login with too long password', ()=>{
    cy.visit('localhost:8098')
    cy.get('#username').type('test@mail.com')
    cy.get('#password').type('1234545678912345678')
    cy.get('.login-form').submit()
    cy.get('[data-test-id=wrong-password]').should('be.visible')
    cy.get('[data-test-id=wrong-password]').contains('The password must not be greater than 16 characters')
  })

  function makeid(length) {
    var result = '';
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
       result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
 }

  const mail = makeid(8) + "@mail.com"

  it('Login with new user', ()=>{
    cy.visit('localhost:8098/login')
    cy.get('[data-test-id=signup-link]').click()
    cy.url().should('include', '/signup')
    cy.get('#signupEmail').type(mail)
    cy.get('#signupUsername').type('TestUser')
    cy.get('#password').type('12345678')
    cy.get('.signup-form').submit()
    cy.get('[data-test-id=created-user-alert]').should('be.visible')
    cy.get('[data-test-id=login-link]').click()
    cy.url().should('include', '/login')
    cy.get('#username').type(mail)
    cy.get('#password').type('12345678')
    cy.get('.login-form').submit()
    cy.url().should('include', '/')
    cy.get('.main-content').contains('Hello')
  })
})