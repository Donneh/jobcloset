import ApplicationLogo from "@/Components/ApplicationLogo.jsx";
import {
    Bars3Icon,
    GiftIcon,
    HomeIcon,
} from "@heroicons/react/24/solid/index.js";
import { AnimatePresence, motion } from "framer-motion";
import { useState } from "react";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.jsx";

export default function ResponsiveNavbar() {
    const [isOpen, setIsOpen] = useState(false);

    const handleToggleMenu = () => {
        setIsOpen((isOpen) => !isOpen);
    };

    const submenuVariants = {
        open: {
            opacity: 1,
            height: "auto",
            transition: { duration: 0.3 }, // Adjust the duration as desired
        },
        closed: {
            opacity: 0,
            height: "10px",
            transition: { duration: 2.3 }, // Adjust the duration to match the open duration
        },
    };

    return (
        <div className="w-screen p-2 md:hidden fixed top-0">
            <nav
                className={`box-border backdrop-blur bg-gray-950 rounded-xl flex-col px-4 flex ${
                    isOpen ? "h-full" : "h-16"
                }`}
            >
                <div className="flex justify-between w-full items-center h-16">
                    <ApplicationLogo className="w-12 h-12 fill-white" />

                    <div className="" onClick={handleToggleMenu}>
                        <Bars3Icon className="w-8 h-10 fill-white" />
                        <span className="sr-only">Menu</span>
                    </div>
                </div>

                <AnimatePresence>
                    {isOpen && (
                        <motion.div
                            className="overflow-hidden"
                            initial="closed"
                            animate="open"
                            exit="closed"
                            variants={submenuVariants}
                        >
                            <nav className="h-full px-4 py-8 mt-8 space-y-2">
                                <ResponsiveNavLink
                                    href={route("dashboard")}
                                    className=""
                                    active={route().current("dashboard")}
                                >
                                    <HomeIcon className="w-6 h-6 mr-2" />
                                    <span>Dashboard</span>
                                </ResponsiveNavLink>
                                <ResponsiveNavLink
                                    href={route("shop.index")}
                                    className=""
                                    active={route().current("shop.index")}
                                >
                                    <GiftIcon className="w-6 h-6 mr-2" />
                                    <span>Shop</span>
                                </ResponsiveNavLink>
                                <ResponsiveNavLink
                                    href={route("users.index")}
                                    className=""
                                    active={route().current("users.*")}
                                >
                                    <GiftIcon className="w-6 h-6 mr-2" />
                                    <span>Users</span>
                                </ResponsiveNavLink>
                                <ResponsiveNavLink
                                    href={route("products.index")}
                                    className=""
                                    active={route().current("products.index")}
                                >
                                    <GiftIcon className="w-6 h-6 mr-2" />
                                    <span>Product</span>
                                </ResponsiveNavLink>
                                <ResponsiveNavLink
                                    href={route("departments.index")}
                                    className=""
                                    active={route().current(
                                        "departments.index"
                                    )}
                                >
                                    <GiftIcon className="w-6 h-6 mr-2" />
                                    <span>Departments</span>
                                </ResponsiveNavLink>
                                <ResponsiveNavLink
                                    href={route("job-titles.index")}
                                    className=""
                                    active={route().current("job-titles.index")}
                                >
                                    <GiftIcon className="w-6 h-6 mr-2" />
                                    <span>Job titles</span>
                                </ResponsiveNavLink>
                                <ResponsiveNavLink
                                    href={route("locations.index")}
                                    className=""
                                    active={route().current("locations.index")}
                                >
                                    <GiftIcon className="w-6 h-6 mr-2" />
                                    <span>Locations</span>
                                </ResponsiveNavLink>
                            </nav>
                        </motion.div>
                    )}
                </AnimatePresence>
            </nav>
        </div>
    );
}
