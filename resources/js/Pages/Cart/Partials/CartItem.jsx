import { XMarkIcon } from "@heroicons/react/20/solid/index.js";
import { useForm } from "@inertiajs/react";

export default function CartItem({ item }) {
    const { post, delete: destroy } = useForm({
        item: item,
    });

    const addOneToCart = (e, item) => {
        e.preventDefault();
        post(route("cart.store", item));
    };

    const removeOneFromCart = (e, item) => {
        e.preventDefault();
        destroy(route("cart.remove", item.id), {
            _method: "delete",
        });
    };

    const deleteFromCart = (e, item) => {
        e.preventDefault();
        destroy(route("cart.destroy", item.id), {
            _method: "delete",
        });
    };

    return (
        <div key={item.product.id} className="flex py-6 sm:py-10">
            <div className="flex-shrink-0 rounded-lg bg-gray-200">
                <img
                    src={item.product.image_path}
                    className="h-24 w-24 rounded-md object-cover object-center sm:h-48 sm:w-48"
                    alt={item.product.name}
                />
            </div>

            <div className="ml-4 flex flex-1 flex-col justify-between sm:ml-6">
                <div className="relative pr-9 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:pr-0">
                    <div>
                        <div className="flex justify-between">
                            <h3 className="text-sm">{item.product.name}</h3>
                        </div>
                        <p className="mt-1 text-sm font-medium text-gray-900">
                            {item.product.price.currency}{" "}
                            {item.product.price.amount}
                        </p>
                    </div>

                    <div className="mt-4 sm:mt-0 sm:pr-9">
                        <label
                            htmlFor={`quantity-${item.id}`}
                            className="sr-only"
                        >
                            Quantity,
                            {item.product.name}
                        </label>
                        <div className="flex items-center border-gray-100">
                            <form
                                onSubmit={(e) =>
                                    removeOneFromCart(e, item.product)
                                }
                            >
                                <button
                                    type="submit"
                                    className="cursor-pointer rounded-l bg-gray-100 py-1 px-3.5 duration-100 hover:bg-blue-500 hover:text-blue-50"
                                >
                                    -
                                </button>
                            </form>
                            <input
                                className="h-8 w-8 border bg-gray-100 text-center text-xs outline-none border-1 border-gray-200"
                                type="text"
                                disabled
                                value={item.quantity}
                                min="1"
                            />
                            <form
                                onSubmit={(e) => addOneToCart(e, item.product)}
                            >
                                <button
                                    type="submit"
                                    className="cursor-pointer rounded-r bg-gray-100 py-1 px-3 duration-100 hover:bg-blue-500 hover:text-blue-50"
                                >
                                    +
                                </button>
                            </form>
                        </div>

                        <div className="absolute right-0 top-0">
                            <form
                                onSubmit={(e) =>
                                    deleteFromCart(e, item.product)
                                }
                            >
                                <button
                                    type="submit"
                                    className="-m-2 inline-flex p-2 text-gray-400 hover:text-gray-500"
                                >
                                    <span className="sr-only">Remove</span>
                                    <XMarkIcon
                                        className="h-5 w-5"
                                        aria-hidden="true"
                                    />
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}
