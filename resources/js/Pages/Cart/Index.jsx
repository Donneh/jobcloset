import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, useForm, usePage } from "@inertiajs/react";
import { XMarkIcon } from "@heroicons/react/20/solid";
import PrimaryButton from "@/Components/PrimaryButton.jsx";
import { ShoppingBagIcon } from "@heroicons/react/24/outline";

export default function Index({ items, total }) {
    const { auth } = usePage().props;
    const { post, delete: destroy } = useForm();

    console.log(items);
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
        <AuthenticatedLayout user={auth.user}>
            <Head title="Cart" />

            <div className="bg-white">
                <div className="mx-auto max-w-2xl px-4 pb-24 pt-8 sm:px-6 lg:max-w-7xl lg:px-8">
                    <div className="flex justify-between items-center">
                        <h1 className="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                            Your bag
                        </h1>

                        <div>
                            <ShoppingBagIcon className="w-8 h-8" />
                        </div>
                    </div>

                    <div>
                        <div className="mt-12 lg:grid lg:grid-cols-12 lg:items-start lg:gap-x-12 xl:gap-x-16">
                            <section
                                aria-labelledby="cart-heading"
                                className="lg:col-span-7"
                            >
                                <h2 id="cart-heading" className="sr-only">
                                    Items in your shopping bag
                                </h2>

                                <div
                                    role="list"
                                    className="divide-y divide-gray-200 border-b border-t border-gray-200"
                                    key="5"
                                >
                                    {items !== null &&
                                    Object.keys(items).length > 0 ? (
                                        Object.entries(items).map(
                                            ([key, item]) => (
                                                <div
                                                    key={item.product.id}
                                                    className="flex py-6 sm:py-10"
                                                >
                                                    <div className="flex-shrink-0">
                                                        <img
                                                            src={
                                                                item.product
                                                                    .image_path
                                                            }
                                                            className="h-24 w-24 rounded-md object-cover object-center sm:h-48 sm:w-48"
                                                        />
                                                    </div>

                                                    <div className="ml-4 flex flex-1 flex-col justify-between sm:ml-6">
                                                        <div className="relative pr-9 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:pr-0">
                                                            <div>
                                                                <div className="flex justify-between">
                                                                    <h3 className="text-sm">
                                                                        {
                                                                            item
                                                                                .product
                                                                                .name
                                                                        }
                                                                    </h3>
                                                                </div>
                                                                <p className="mt-1 text-sm font-medium text-gray-900">
                                                                    {
                                                                        item
                                                                            .product
                                                                            .price
                                                                            .currency
                                                                    }{" "}
                                                                    {
                                                                        item
                                                                            .product
                                                                            .price
                                                                            .amount
                                                                    }
                                                                </p>
                                                            </div>

                                                            <div className="mt-4 sm:mt-0 sm:pr-9">
                                                                <label
                                                                    htmlFor={`quantity-${item.id}`}
                                                                    className="sr-only"
                                                                >
                                                                    Quantity,
                                                                    {
                                                                        item
                                                                            .product
                                                                            .name
                                                                    }
                                                                </label>
                                                                <div className="flex items-center border-gray-100">
                                                                    <form
                                                                        onSubmit={(
                                                                            e
                                                                        ) =>
                                                                            removeOneFromCart(
                                                                                e,
                                                                                item.product
                                                                            )
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
                                                                        value={
                                                                            item.quantity
                                                                        }
                                                                        min="1"
                                                                    />
                                                                    <form
                                                                        onSubmit={(
                                                                            e
                                                                        ) =>
                                                                            addOneToCart(
                                                                                e,
                                                                                item.product
                                                                            )
                                                                        }
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
                                                                        onSubmit={(
                                                                            e
                                                                        ) =>
                                                                            deleteFromCart(
                                                                                e,
                                                                                item.product
                                                                            )
                                                                        }
                                                                    >
                                                                        <button
                                                                            type="submit"
                                                                            className="-m-2 inline-flex p-2 text-gray-400 hover:text-gray-500"
                                                                        >
                                                                            <span className="sr-only">
                                                                                Remove
                                                                            </span>
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
                                            )
                                        )
                                    ) : (
                                        <div className="flex justify-center items-center">
                                            <p className="text-gray-500">
                                                Your cart is empty
                                            </p>
                                        </div>
                                    )}
                                </div>
                            </section>

                            {/* Order summary */}
                            <section
                                aria-labelledby="summary-heading"
                                className="mt-16 rounded-lg bg-gray-50 px-4 py-6 sm:p-6 lg:col-span-5 lg:mt-0 lg:p-8"
                            >
                                <h2
                                    id="summary-heading"
                                    className="text-lg font-medium text-gray-900"
                                >
                                    Order summary
                                </h2>

                                <dl className="mt-6 space-y-4">
                                    <div className="flex items-center justify-between border-t border-gray-200 pt-4">
                                        <dt className="text-base font-medium text-gray-900">
                                            Order total
                                        </dt>
                                        <dd className="text-base font-medium text-gray-900">
                                            {total.currency} {total.amount}
                                        </dd>
                                    </div>
                                </dl>

                                <div className="mt-6">
                                    <PrimaryButton
                                        type="submit"
                                        className="w-full flex text-center justify-center py-4"
                                    >
                                        Checkout
                                    </PrimaryButton>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
