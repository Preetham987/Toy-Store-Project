<!-- Filter Button for Mobile -->
<button id="mobileFilterBtn" class="filter-button">Filter</button>

<!-- Sidebar -->
<div id="sidebar" class="sidebar">

  <!-- Close Button for Mobile -->
  <button id="closeSidebarBtn" class="close-sidebar">&times;</button>

@if(!empty($selectedFilters))
    <div class="selected-filters" style="margin-bottom: 10px; display: flex; flex-wrap: wrap; gap: 5px;">
        @foreach($sections as $section)
            @if(!empty($selectedFilters[$section['name']]))
                @foreach($section['items']->whereIn('id', $selectedFilters[$section['name']]) as $selectedItem)
                    <div class="filter-chip" 
                         style="border: 1px solid black; border-radius: 16px; padding: 4px 10px; display: inline-flex; align-items: center; background-color: #f8f8f8; font-size: 14px;">
                        {{ $selectedItem->title }}
                        <button type="button" 
                                onclick="removeFilter('{{ $section['name'] }}', '{{ $selectedItem->id }}')" 
                                style="background: none; border: none; margin-left: 5px; font-size: 14px; cursor: pointer;">
                            ✕
                        </button>
                    </div>
                @endforeach
            @endif
        @endforeach
    </div>
@endif

<script>
function removeFilter(name, id) {
    const form = document.getElementById('filterForm');
    const checkboxes = form.querySelectorAll(`input[name="${name}[]"]`);
    checkboxes.forEach(cb => {
        if (cb.value == id) cb.checked = false;
    });
    form.submit();
}
</script>

  <!-- Sidebar Sections -->
@php
    $sections = [
        ['title' => 'Department', 'name' => 'categories', 'items' => $categories, 'route' => 'products.byCategory'],
        ['title' => 'Brand', 'name' => 'brands', 'items' => $brands, 'route' => 'products.byBrand'],
        ['title' => 'Series', 'name' => 'series', 'items' => $series, 'route' => 'products.bySeries'],
        ['title' => 'Product Type', 'name' => 'product_types', 'items' => $productTypes, 'route' => 'products.byProductType'],
        ['title' => 'Featured In', 'name' => 'featuredin', 'items' => $featuredin, 'route' => 'products.byFeaturedIn'],
        ['title' => 'Character', 'name' => 'characters', 'items' => $character, 'route' => 'products.byCharacter'],
        ['title' => 'Company', 'name' => 'companies', 'items' => $companies, 'route' => 'products.byCompany'],
        ['title' => 'Scale', 'name' => 'scales', 'items' => $scales, 'route' => 'products.byScale'],
        ['title' => 'Size', 'name' => 'sizes', 'items' => $sizes, 'route' => 'products.bySize'],
    ];
@endphp

<form id="filterForm" method="GET" action="{{ route('product-search') }}">
    @foreach($sections as $section)
        <div class="sidebar-section">
            <div class="sidebar-title">{{ $section['title'] }}</div>
            <ul>
                @foreach($section['items'] as $index => $item)
                    <li class="{{ $index >= 6 ? 'extra-item' : '' }}" style="{{ $index >= 6 ? 'display:none;' : '' }}">
                        <label>
                            <input type="checkbox" 
                                   name="{{ $section['name'] }}[]" 
                                   value="{{ $item->id }}"
                                   {{ in_array($item->id, request($section['name'], [])) ? 'checked' : '' }}>
                            {{ $item->title }}
                            <span class="count">({{ $item->products_count }})</span>
                        </label>
                    </li>
                @endforeach
            </ul>
            @if(count($section['items']) > 6)
                <button class="show-more-btn" type="button">
                    <span class="text">Show More</span> <span class="symbol">+</span>
                </button>
            @endif
        </div>
    @endforeach

</form>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Show More logic remains the same
    document.querySelectorAll('.sidebar-section').forEach(section => {
        const showMoreBtn = section.querySelector('.show-more-btn');
        if (showMoreBtn) {
            let expanded = false;
            const extraItems = section.querySelectorAll('.extra-item');

            showMoreBtn.addEventListener('click', function () {
                extraItems.forEach(el => {
                    el.style.display = expanded ? 'none' : 'list-item';
                });

                showMoreBtn.querySelector('.text').textContent = expanded 
                    ? 'Show More' 
                    : 'Show Less';

                showMoreBtn.querySelector('.symbol').textContent = expanded 
                    ? '+' 
                    : '-';

                expanded = !expanded;
            });
        }
    });

    // ✅ Auto-submit form on checkbox change
    document.querySelectorAll('#filterForm input[type="checkbox"]').forEach(cb => {
        cb.addEventListener('change', function () {
            document.getElementById('filterForm').submit();
        });
    });
});
</script>

  <!-- <div class="checkbox-group">
    <label>
      <input type="checkbox" name="Hide Sold Out" value="Hide Sold Out">
      Hide Sold Out
    </label><br>

    <label>
      <input type="checkbox" name="Hide Pre-Order" value="Hide Pre-Order">
      Hide Pre-Order
    </label><br>

    <label>
      <input type="checkbox" name="Hide In Stock" value="Hide In Stock">
      Hide In Stock
    </label>
  </div> -->
</div>

<style>
  .sidebar-section ul li label:hover {
        color: #d32f2f;
        text-decoration: underline;
        cursor: pointer;
    }
  .filter-button {
    display: none;
    background-color: #d32f2f;
    color: #fff;
    padding: 10px 16px;
    font-weight: bold;
    border: none;
    cursor: pointer;
    width: 100%;
    text-align: center;
  }

  .close-sidebar {
    display: none;
    background: transparent;
    color: #000;
    font-size: 24px;
    border: none;
    position: absolute;
    top: 10px;
    right: 16px;
    cursor: pointer;
  }

  @media (max-width: 768px) {
    .sidebar {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 85%;
      height: 100%;
      background: #fff;
      z-index: 9999;
      overflow-y: scroll;
      padding: 20px;
      box-shadow: 2px 0 10px rgba(0, 0, 0, 0.3);
      transition: transform 0.3s ease-in-out;
    }

    .sidebar.active {
      display: block;
    }

    .close-sidebar {
      display: block;
    }

    .filter-button {
      display: block;
    }
  }
</style>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const filterBtn = document.getElementById("mobileFilterBtn");
    const sidebar = document.getElementById("sidebar");
    const closeBtn = document.getElementById("closeSidebarBtn");

    filterBtn.addEventListener("click", function () {
      sidebar.classList.add("active");
    });

    closeBtn.addEventListener("click", function () {
      sidebar.classList.remove("active");
    });
  });
</script>
