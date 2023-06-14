describe("register", () => {
    context("when user is not logged in", () => {
        it("shows a register page", () => {
            cy.visit("/register");

            cy.contains("Register");
        });

        context("User enters invalid data", () => {
            it(" requires a valid email address", () => {
                cy.visit("/register");

                cy.get('input[name="name"]').type("Test User");
                cy.get('input[name="email"]').type("invalid-email");
                cy.get('input[name="password"]').type("password");
                cy.get('input[name="password_confirmation"]').type("password");
                cy.get('button[type="submit"]').click();

                cy.contains("The email must be a valid email address.");
            });
        });
    });
});
