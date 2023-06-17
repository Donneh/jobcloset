import ApplicationLogo from "@/Components/ApplicationLogo.jsx";
import NavLink from "@/Components/NavLink.jsx";
import { GiftIcon, HomeIcon } from "@heroicons/react/24/solid/index.js";
import UserDropdown from "@/Components/UserDropdown.jsx";

export default function Sidebar({ user }) {
    return (
        <aside className="w-64 h-screen p-2 hidden md:block sticky top-0">
            <div className="bg-gray-950 h-full w-full rounded-xl px-4 py-8 flex flex-col">
                <ApplicationLogo className="w-16 h-16 fill-white" />

                <nav className="mt-8 space-y-2 w-full">
                    <NavLink
                        href={route("dashboard")}
                        className=""
                        active={route().current("dashboard")}
                    >
                        <HomeIcon className="w-6 h-6 mr-2" />
                        <span>Dashboard</span>
                    </NavLink>

                    <NavLink
                        href={route("product.index")}
                        className=""
                        active={route().current("product.*")}
                    >
                        <GiftIcon className="w-6 h-6 mr-2" />
                        <span>Product</span>
                    </NavLink>
                </nav>

                <nav className={"text-white mt-auto opacity-100"}>
                    {/*<NavLink>*/}
                    <UserDropdown user={user}></UserDropdown>
                    {/*</NavLink>*/}
                </nav>
            </div>
        </aside>
    );
}
