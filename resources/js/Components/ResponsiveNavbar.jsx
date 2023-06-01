import ApplicationLogo from "@/Components/ApplicationLogo.jsx";
import { Bars3Icon, GiftIcon, HomeIcon } from "@heroicons/react/24/solid/index.js";
import { motion } from "framer-motion";
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
            height: "0px",
            transition: { duration: 6.3 }, // Adjust the duration to match the open duration
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

                {isOpen && (
                    <motion.div
                        className="overflow-hidden"
                        initial="closed"
                        animate="open"
                        exit="closed"
                        variants={submenuVariants}
                    >
                        <nav className="h-full px-4 py-8 mt-8">
                            <ResponsiveNavLink
                                href={route("dashboard")}
                                className=""
                                active={route().current("dashboard")}
                            >
                                <HomeIcon className="w-6 h-6 mr-2" />
                                <span>Dashboard</span>
                            </ResponsiveNavLink>

                            <ResponsiveNavLink
                                href={route("product.create")}
                                className=""
                                active={route().current("product.create")}
                            >
                                <GiftIcon className="w-6 h-6 mr-2" />
                                <span>Product</span>
                            </ResponsiveNavLink>
                        </nav>
                    </motion.div>
                )}
            </nav>
        </div>
    );
}
