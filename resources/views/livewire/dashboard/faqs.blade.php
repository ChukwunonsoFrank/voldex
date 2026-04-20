<div>
    <!-- App Capsule -->
    <div id="appCapsule">
        <!-- Transactions -->
        <div class="section mt-2">
            <div class="section-title fw-bold">FAQs</div>

            <div class="accordion" id="accordionExample1" x-data="{ open: null }">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold" :class="open !== 1 && 'collapsed'" type="button"
                            @click="open = open === 1 ? null : 1">
                            What is the platform all about?
                        </button>
                    </h2>
                    <div x-show="open === 1" x-collapse x-cloak class="accordion-collapse">
                        <div class="accordion-body text-black">
                            Our platform is dedicated service provider that specializes in assisting merchants with the
                            optimization of their data, aiming to signicantly enhance the visibility of their products
                            or services and ultimately boost sales.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold" :class="open !== 2 && 'collapsed'" type="button"
                            @click="open = open === 2 ? null : 2">
                            How do I start the work?
                        </button>
                    </h2>
                    <div x-show="open === 2" x-collapse x-cloak class="accordion-collapse">
                        <div class="accordion-body text-black">
                            Orders are seamlessly assigned to your workbench account by the system, determined by your
                            agent level. The product's price is based on the workbench wallet balance, which remains
                            unless specific events necessitate adjustments. To optimize a product, navigate to
                            "Start", click on the "Start now" button, and then submit your optimization.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold" :class="open !== 3 && 'collapsed'" type="button"
                            @click="open = open === 3 ? null : 3">
                            What payment method do the platform accept?
                        </button>
                    </h2>
                    <div x-show="open === 3" x-collapse x-cloak class="accordion-collapse">
                        <div class="accordion-body text-black">
                            For security reasons and to ensure agent privacy we prefer the use of cryptocurrency only.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold" :class="open !== 4 && 'collapsed'" type="button"
                            @click="open = open === 4 ? null : 4">
                            What is your return/exchange policy? Do we make actual purchases?
                        </button>
                    </h2>
                    <div x-show="open === 4" x-collapse x-cloak class="accordion-collapse">
                        <div class="accordion-body text-black">
                            Our workbench is intricately synchronized with the shopping mall's ERP systems. Orders are
                            treated as return products, and the system facilitates an instant refund while commissioning
                            you for your effort.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold" :class="open !== 5 && 'collapsed'" type="button"
                            @click="open = open === 5 ? null : 5">
                            Is my personal information secure on our website?
                        </button>
                    </h2>
                    <div x-show="open === 5" x-collapse x-cloak class="accordion-collapse">
                        <div class="accordion-body text-black">
                            We prioritize the security of any private information entrusted to us, despite its minimal
                            nature. To maintain security, we advise against using sensitive details such as birthdays,
                            ID numbers, or addresses as passwords. We only require username and phone number for
                            registration.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold" :class="open !== 6 && 'collapsed'" type="button"
                            @click="open = open === 6 ? null : 6">
                            How do I contact customer service?
                        </button>
                    </h2>
                    <div x-show="open === 6" x-collapse x-cloak class="accordion-collapse">
                        <div class="accordion-body text-black">
                            For any inquiries, click on the homepages, access your profile, and click "CONTACT US". We
                            recommend reaching out through the website to ensure the most accurate and timely
                            assistance, given potential changes in customer service shifts.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold" :class="open !== 7 && 'collapsed'" type="button"
                            @click="open = open === 7 ? null : 7">
                            Are the any ongoing promotions or discounts?
                        </button>
                    </h2>
                    <div x-show="open === 7" x-collapse x-cloak class="accordion-collapse">
                        <div class="accordion-body text-black">
                            Stay updated on ongoing promotions and discounts by check the EVENTS section on the the
                            homepage.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold" :class="open !== 8 && 'collapsed'" type="button"
                            @click="open = open === 8 ? null : 8">
                            Can I modify or cancel my order after placing it?
                        </button>
                    </h2>
                    <div x-show="open === 8" x-collapse x-cloak class="accordion-collapse">
                        <div class="accordion-body text-black">
                            Optimization products are randomly release by the system and cannot be altered, canceled, or
                            skipped by any user or staff member. This policy aims to prevent bias, unethical conduct,
                            and financial misconduct within the system.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold" :class="open !== 9 && 'collapsed'" type="button"
                            @click="open = open === 9 ? null : 9">
                            What is your response time for customer inquiries?
                        </button>
                    </h2>
                    <div x-show="open === 9" x-collapse x-cloak class="accordion-collapse">
                        <div class="accordion-body text-black">
                            Due to the high number of users, the most efficient way to contact us is through the
                            "Contact Us" button on the website.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold" :class="open !== 10 && 'collapsed'" type="button"
                            @click="open = open === 10 ? null : 10">
                            How do I terminate my contract, and do I get paid after terminating my contract?
                        </button>
                    </h2>
                    <div x-show="open === 10" x-collapse x-cloak class="accordion-collapse">
                        <div class="accordion-body text-black">
                            In the event of the company terminating your contract, it assumes responsibility and ensures
                            payment of wages and earned commissions. However, if you choose to terminate the contract
                            for personal reasons, the company is not obligated to make any payments.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold" :class="open !== 11 && 'collapsed'" type="button"
                            @click="open = open === 11 ? null : 11">
                            What results can I expect from using the platform?
                        </button>
                    </h2>
                    <div x-show="open === 11" x-collapse x-cloak class="accordion-collapse">
                        <div class="accordion-body text-black">
                            Clients usually witness a substantial improvement in the visibility of their products or
                            services, leading to increased sales and an overall enhanced market performance. Agents, in
                            turn, receive income and commissions for contributing to the improvement of client sales
                            visibility and brand awareness.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold" :class="open !== 12 && 'collapsed'" type="button"
                            @click="open = open === 12 ? null : 12">
                            How do I make deposits?
                        </button>
                    </h2>
                    <div x-show="open === 12" x-collapse x-cloak class="accordion-collapse">
                        <div class="accordion-body text-black">
                            To make an advance on our workbench, navigate to the home page and click on the "Recharge"
                            button. Contact our customer service for assistance, and upon completing the advance, submit
                            a screenshot of the successful transaction. Ensure that the remitter's name and remittance
                            amount match the information provided.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold" :class="open !== 13 && 'collapsed'" type="button"
                            @click="open = open === 13 ? null : 13">
                            How to make withdrawals?
                        </button>
                    </h2>
                    <div x-show="open === 13" x-collapse x-cloak class="accordion-collapse">
                        <div class="accordion-body text-black">
                            Initiate a withdrawal by first binding your withdrawal information on the workbench. Access
                            the withdrawal screen on the home page, enter the desired withdrawal amount and password,
                            and proceed by clicking the "Withdraw" button. The precise arrival time of the withdrawal is
                            contingent upon the crypto currency exchange's processing time.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold" :class="open !== 14 && 'collapsed'" type="button"
                            @click="open = open === 14 ? null : 14">
                            Can I make payment to an external wallet?
                        </button>
                    </h2>
                    <div x-show="open === 14" x-collapse x-cloak class="accordion-collapse">
                        <div class="accordion-body text-black">
                            No. Always confirm an updated wallet address from the customer service before making
                            payment.
                        </div>
                    </div>
                </div>
            </div>

            <div class="alert alert-primary mt-4 mb-2" role="alert">
                <span class="font-bold">Notice</span>: Kindly contact the customer service for further assistance. Our
                working hours are 9:00 AM - 22:00PM
            </div>
        </div>
        <!-- * Transactions -->
    </div>
    <!-- * App Capsule -->
</div>
