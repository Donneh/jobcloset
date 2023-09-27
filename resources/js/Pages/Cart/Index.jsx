import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, useForm, usePage } from "@inertiajs/react";
import { XMarkIcon } from "@heroicons/react/20/solid";
import PrimaryButton from "@/Components/PrimaryButton.jsx";
import { ShoppingBagIcon } from "@heroicons/react/24/outline";
import { useEffect, useRef } from "react";
import AdyenDropIn from "@/Components/AdyenDropIn.jsx";
import CartList from "@/Pages/Cart/Partials/CartList.jsx";
export default function Index({ items, total, sessionId, sessionData }) {
    const { auth } = usePage().props;
    const { post, delete: destroy } = useForm({
        cartItems: items,
    });

    const placeOrder = (e) => {
        e.preventDefault();
        // console.log(items);
        post(route("payment.create"));
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

                                <CartList items={items} />
                            </section>

                            <div className={" lg:col-span-5"}>
                                {/* Order summary */}
                                <section
                                    aria-labelledby="summary-heading"
                                    className="rounded-lg bg-gray-50 px-4 py-6 sm:p-6lg:mt-0 lg:p-8 mb-5"
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

                                    {(sessionData && (
                                        <section className={"mt-4"}>
                                            <AdyenDropIn
                                                sessionId={sessionId}
                                                sessionData={sessionData}
                                            />
                                        </section>
                                    )) || (
                                        <div className="mt-6">
                                            <form onSubmit={placeOrder}>
                                                <PrimaryButton
                                                    type="submit"
                                                    className="w-full flex text-center justify-center py-4"
                                                >
                                                    Checkout
                                                </PrimaryButton>
                                            </form>
                                        </div>
                                    )}
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
