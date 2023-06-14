import { usePage } from "@inertiajs/react";
import { useEffect, useState } from "react";
import { AnimatePresence, motion } from "framer-motion";

export default function FlashMessage() {
    const { flash } = usePage().props;
    const [showFlash, setShowFlash] = useState(true);

    useEffect(() => {
        if (flash.message) {
            setShowFlash(true);

            const timeout = setTimeout(() => {
                setShowFlash(false);
            }, 3000);

            return () => clearTimeout(timeout);
        }
    }, [flash.message]);

    return (
        <AnimatePresence>
            {showFlash && flash.message && (
                <motion.div
                    initial={{ opacity: 0, y: 50 }}
                    animate={{ opacity: 1, y: 0 }}
                    exit={{ opacity: 0, y: 50 }}
                    transition={{ duration: 1 }}
                    className="absolute bottom-8 right-8 flex items-center w-full max-w-xs p-4 space-x-4 text-gray-500 bg-white divide-x divide-gray-200 rounded-lg shadow space-x"
                    role={"alert"}
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        strokeWidth={1.5}
                        stroke="currentColor"
                        className="w-6 h-6"
                    >
                        <path
                            strokeLinecap="round"
                            strokeLinejoin="round"
                            d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"
                        />
                    </svg>
                    <div className="pl-4 text-sm font-normal">
                        {flash.message}
                    </div>
                </motion.div>
            )}
        </AnimatePresence>
    );
}
