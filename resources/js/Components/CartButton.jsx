import { ShoppingBagIcon } from "@heroicons/react/24/outline/index.js";
import { Link, usePage } from "@inertiajs/react";

export default function CartButton({ className }) {
    const cart = usePage().props.cart;
    let totalQuantity = 0;

    console.log(cart);
    if (cart) {
        Object.values(cart).forEach((item) => {
            totalQuantity += item.quantity;
        });
    }

    return (
        <div className={className}>
            <Link
                href={route("cart.index")}
                className={"relative hover:opacity-70"}
            >
                <div
                    className={
                        "absolute bg-violet-700 text-white rounded-full h-5 w-5 flex justify-center items-center text-xs -right-0 top-0"
                    }
                >
                    {totalQuantity}
                </div>
                <ShoppingBagIcon className="w-8 h-8" />
            </Link>
        </div>
    );
}
