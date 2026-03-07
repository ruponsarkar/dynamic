<div class="card-c p-2">
    <div class="row">

        <div class="col-md-4">
            <div class="bg-light p-3">
                <div class="text-center">
                    <h2 class="counter" data-count="7">0</h2>
                    <div>Journals</div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="p-3">
                <div class="text-center">
                    <h2 class="counter" data-count="74">0</h2>
                    <div>Editors & Reviewers</div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="bg-light p-3">
                <div class="text-center">
                    <h2 class="counter" data-count="767">0</h2>
                    <div>Articles Published</div>
                </div>
            </div>
        </div>

    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const counters = document.querySelectorAll('.counter');
        const speed = 200; // smaller = faster
    
        counters.forEach(counter => {
            const updateCount = () => {
                const target = +counter.getAttribute('data-count');
                const count = +counter.innerText;
    
                const increment = Math.ceil(target / speed);
    
                if (count < target) {
                    counter.innerText = count + increment;
                    setTimeout(updateCount, 20);
                } else {
                    counter.innerText = target + "+";
                }
            };
    
            updateCount();
        });
    });
    </script>
    