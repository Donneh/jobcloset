import { XMarkIcon } from "@heroicons/react/20/solid/index.js";
import CartItem from "@/Pages/Cart/Partials/CartItem.jsx";

export default function CartList({ items }) {
    return (
        <div
            role="list"
            className="divide-y divide-gray-200 border-b border-t border-gray-200"
            key="5"
        >
            {items !== null && Object.keys(items).length > 0 ? (
                Object.entries(items).map(([key, item]) => (
                    <CartItem item={item} key={key} />
                ))
            ) : (
                <div className="flex justify-center items-center">
                    <p className="text-gray-500">Your cart is empty</p>
                </div>
            )}
        </div>
    );
}
