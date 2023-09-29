import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import ProductGrid from "@/Pages/Shop/Partials/ProductGrid.jsx";
import MainCard from "@/Components/MainCard.jsx";
import MainCardHeader from "@/Components/MainCardHeader.jsx";

export default function Index({ auth, products }) {
    return (
        <AuthenticatedLayout user={auth.user} pageTitle={"Shop"}>
            <MainCard>
                <MainCardHeader title={"Shop"} />

                <div className="mt-6">
                    <ProductGrid products={products} />
                </div>
            </MainCard>
        </AuthenticatedLayout>
    );
}
