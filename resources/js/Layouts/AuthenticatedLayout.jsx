import { useState } from 'react';
import Sidebar from "@/Components/Sidebar.jsx";
import ResponsiveNavbar from "@/Components/ResponsiveNavbar.jsx";

export default function Authenticated({ user, header, children }) {
    const [showingNavigationDropdown, setShowingNavigationDropdown] = useState(false);

    return (
        <div className="min-h-screen md:flex max-w-screen-2xl mx-auto">

            <Sidebar />

            <ResponsiveNavbar />

            <main className="p-2 px-4 md:px-2 w-full mt-20 md:mt-0">{children}</main>
        </div>
    );
}
