import { useState } from "react";
import Sidebar from "@/Components/Sidebar.jsx";
import ResponsiveNavbar from "@/Components/ResponsiveNavbar.jsx";
import FlashMessage from "@/Components/FlashMessage.jsx";
import { Head } from "@inertiajs/react";

export default function AuthenticatedLayout({ pageTitle, children }) {
    const [showingNavigationDropdown, setShowingNavigationDropdown] =
        useState(false);

    const [heading, setHeading] = useState("Dashboard");

    return (
        <div className="min-h-screen md:flex max-w-screen-2xl mx-auto">
            <Head title={pageTitle} />
            <Sidebar />

            <ResponsiveNavbar />

            <main className="p-2 px-4 md:px-2 w-full mt-20 md:mt-0">
                {children}

                <FlashMessage />
            </main>
        </div>
    );
}
