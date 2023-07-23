describe("login", () => {
    before(() => {
        cy.refreshDatabase().seed();

        cy.create("App\\Models\\User", {
            name: "John Doe",
            email: "johndoe@example.com",
            password: "password",
        });
    });

    context("with invalid credentials", () => {
        it("requires a valid email address", () => {
            cy.visit("/login");

            cy.get('input[type="email"]').type("foobar");
            cy.get('input[type="password"]').type("password");
            cy.get('button[type="submit"]').click();

            cy.get("input:invalid").should("have.length", 1);
        });

        it("requires an existing email address", () => {
            cy.visit("/login");

            cy.get('input[type="email"]').type("foobar@example.com");
            cy.get('input[type="password"]').type("password");
            cy.get('button[type="submit"]').click();

            cy.contains("These credentials do not match our records.");
        });

        it("requires a valid password", () => {
            cy.visit("/login");

            cy.get('input[type="email"]').type("johndoe@example.com");
            cy.get('input[type="password"]').type("foobar");
            cy.get('button[type="submit"]').click();

            cy.contains("These credentials do not match our records.");
        });
    });

    context("with valid credentials", () => {
        it("redirects to the dashboard", () => {
            cy.visit("/login");

            cy.get('input[type="email"]').type("johndoe@example.com");
            cy.get('input[type="password"]').type("password");
            cy.get('button[type="submit"]').click();

            cy.url().should("include", "/dashboard");
        });
    });
});
