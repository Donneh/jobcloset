import ApplicationLogo from "@/Components/ApplicationLogo.jsx";
import NavLink from "@/Components/NavLink.jsx";
import {GiftIcon, HomeIcon} from "@heroicons/react/24/solid/index.js";

export default function Sidebar() {

    return (
        <aside className="w-64 h-screen p-2 hidden md:block sticky top-0">
            <div className="bg-gray-950 h-full w-full rounded-xl px-4 py-8">
                <ApplicationLogo className="w-16 h-16 fill-white" />

                <nav className="px-4 mt-8">
                    <NavLink href={route('dashboard')} className="" active={route().current('dashboard')}>
                        <HomeIcon className="w-6 h-6 mr-2" />
                        <span>Dashboard</span>
                    </NavLink>

                    <NavLink href={route('product.create')} className="" active={route().current('product.create')}>
                        <GiftIcon className="w-6 h-6 mr-2" />
                        <span>Product</span>
                    </NavLink>
                </nav>
            </div>
        </aside>
    )
}
