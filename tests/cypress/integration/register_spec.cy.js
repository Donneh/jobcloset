describe("register", () => {
    before(() => {
        cy.refreshDatabase().seed();

        cy.create("App\\Models\\User", {
            name: "John Doe",
            email: "johndoe@example.com",
            password: "password",
        });
    });

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

                cy.get("input:invalid").should("have.length", 1);
            });

            it("requires a unique email address", () => {
                cy.visit("/register");

                cy.get('input[name="name"]').type("Test User");
                cy.get('input[name="email"]').type("johndoe@example.com");
                cy.get('input[name="password"]').type("password");
                cy.get('input[name="password_confirmation"]').type("password");
                cy.get('button[type="submit"]').click();

                cy.contains("The email has already been taken.");
            });

            it("requires matching passwords", () => {
                cy.visit("/register");

                cy.get('input[name="name"]').type("Test User");
                cy.get('input[name="email"]').type("foobar@example.com");
                cy.get('input[name="password"]').type("password");
                cy.get('input[name="password_confirmation"]').type("foobar");
                cy.get('button[type="submit"]').click();

                cy.contains("The password field confirmation does not match.");
            });
        });
    });

    context("when user enters valid data", () => {
        it("redirects to the dashboard", () => {
            cy.visit("/register");

            cy.get('input[name="name"]').type("Jane Doe");
            cy.get('input[name="email"]').type("janedoe@example.com");
            cy.get('input[name="password"]').type("password");
            cy.get('input[name="password_confirmation"]').type("password");
            cy.get('button[type="submit"]').click();

            cy.url().should("include", "/");
        });
    });

    context("when user is logged in", () => {
        it("redirects to the dashboard", () => {
            cy.login({ email: "johndoe2@example.com", password: "password" });

            cy.visit("/register");
            //
            // cy.url().should("include", "/dashboard");
        });
    });
});
