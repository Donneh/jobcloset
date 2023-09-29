import { Head, Link, useForm } from "@inertiajs/react";
import DeleteProductForm from "@/Pages/Product/Partials/DeleteProductForm.jsx";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";
import MainCard from "@/Components/MainCard.jsx";
import MainCardHeader from "@/Components/MainCardHeader.jsx";

export default function Index({ auth, orders }) {
    return (
        <AuthenticatedLayout user={auth.user} pageTitle={"Orders"}>
            <MainCard>
                <MainCardHeader title={"Orders"} />

                <table className="table-auto max-w-full divide-y divide-gray-300 overflow-x-auto">
                    <thead>
                        <tr>
                            <th
                                scope="col"
                                className="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0"
                            >
                                User
                            </th>
                            <th
                                scope="col"
                                className="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0"
                            >
                                Number
                            </th>
                            <th
                                scope="col"
                                className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                            >
                                Payment method
                            </th>
                            <th
                                scope="col"
                                className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                            >
                                Payment status
                            </th>
                        </tr>
                    </thead>
                    <tbody className="divide-y divide-gray-200">
                        {orders.map((order) => (
                            <tr key={order.id}>
                                <td className="px-3 py-4 text-sm">
                                    {order.user.name}
                                </td>
                                <td className="whitespace-nowrap px-3 py-4 text-sm">
                                    {order.number}
                                </td>
                                <td className="whitespace-nowrap px-3 py-4 text-sm">
                                    {order.payment_method}
                                </td>
                                <td className="px-3 py-4 text-sm">
                                    {order.payment_status}
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </MainCard>
        </AuthenticatedLayout>
    );
}
