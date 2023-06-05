import { Link } from "@inertiajs/react";

export default function ResponsiveNavLink({
    active = false,
    className = "",
    children,
    ...props
}) {
    return (
        <Link
            {...props}
            className={`w-full flex items-start pl-3 pr-4 py-2 ${
                active
                    ? "text-black rounded bg-neutral-50"
                    : "border-transparent text-neutral-50"
            } text-base font-medium focus:outline-none transition duration-150 ease-in-out hover:opacity-80${className}`}
        >
            {children}
        </Link>
    );
}
