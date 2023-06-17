import PrimaryButton from "@/Components/PrimaryButton.jsx";

export default function ProductGrid({ products }) {
    return (
        <div className="-mx-px grid grid-cols-2 border-l border-gray-200 border-t  mt-8 sm:mx-0 md:grid-cols-3 lg:grid-cols-4">
            {products.map((product) => (
                <div
                    key={product.id}
                    className="relative border-b border-r border-gray-200 p-4 sm:p-6"
                >
                    <div className="aspect-h-1 aspect-w-1 overflow-hidden rounded-lg bg-gray-200">
                        <img
                            src={product.image_path}
                            className="h-full w-full object-cover object-center"
                        />
                    </div>
                    <div className="pb-4 pt-10 text-center">
                        <h3 className="text-sm font-medium text-gray-900">
                            {product.name}
                        </h3>
                        <p className="mt-4 text-base font-medium text-gray-900">
                            {product.price.currency} {product.price.amount}
                        </p>
                    </div>
                    <div>
                        <form className="pb-4 pt-10 text-center">
                            <PrimaryButton type="submit">
                                Add to bag
                            </PrimaryButton>
                        </form>
                    </div>
                </div>
            ))}
        </div>
    );
}
