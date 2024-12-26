<?php

namespace App\Http\Controllers\Admin;

use App\Models\Uom;
use App\Models\ItemCard;
use Illuminate\Http\Request;
use App\Models\ItemCardCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\ItemCardStoreRequest;
use App\Http\Requests\Admin\ItemCardUpdateRequest;

class ItemCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = ItemCardCategory::select('id', 'name')->get();
        // Check if it's an AJAX request
        if ($request->ajax()) {
            $search = $request->input('search');
            $categoryId = $request->input('category_id'); // Get the 'category_id' filter if provided
            $itemType = $request->input('item_type'); // Get the 'item_type' filter if provided

            // Query with optional search and filters
            $query = ItemCard::query();

            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('barcode', 'like', '%' . $search . '%')
                        ->orWhere('item_code', 'like', '%' . $search . '%');
                });
            }

            if ($categoryId) { // Check if 'category_id' filter is provided
                $query->where('item_card_category_id', $categoryId);
            }

            if ($itemType) { // Check if 'item_type' filter is provided
                $query->where('item_type', $itemType);
            }

            $data = $query->with('category', 'parent', 'retailUnit', 'unit')
                ->where('company_code', auth()->user()->company_code)
                ->orderby('id', 'DESC')->paginate(PAGINATION_COUNT);

            // Return the data as a JSON response
            return response()->json([
                'html' => view('admin.item_cards._table', ['data' => $data, 'categories' => $categories])->render(),
            ]);
        }

        // Regular request (non-AJAX)
        $data = ItemCard::with('category', 'parent', 'retailUnit', 'unit')
            ->where('company_code', auth()->user()->company_code)
            ->orderby('id', 'DESC')
            ->paginate(PAGINATION_COUNT);

        return view('admin.item_cards.index', compact('data', 'categories'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ItemCardCategory::select('id', 'name')->get();
        $parents = ItemCard::whereNull('parent_id')->get();
        $uoms = Uom::where('is_master', 1)->get();
        $retailUoms = Uom::where('is_master', 0)->get();
        return view('admin.item_cards.create', compact('categories', 'parents', 'uoms', 'retailUoms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemCardStoreRequest $request)
    // public function store(Request $request) 
    {
        $data = $request->validated();

        if ($request->photo) {

            $path = upload_image($request->file('photo'), 'uploads/images');
            $data['photo'] = $path;
        }

        ItemCard::create($data);

        return redirect()->route('admin.item-cards.index')->with('message', 'تم إضافة الصنف بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemCard $itemCard)
    {
        // Retrieve the item card by ID

        // Retrieve categories, parent item cards, and UOMs (Units of Measure)
        $categories = ItemCardCategory::select('id', 'name')->get();
        $parents = ItemCard::whereNull('parent_id')->get();
        $uoms = Uom::where('is_master', 1)->get();
        $retailUoms = Uom::where('is_master', 0)->get();

        // Return the view with the necessary data
        return view('admin.item_cards.edit', compact('categories', 'parents', 'uoms', 'retailUoms', 'itemCard'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ItemCardUpdateRequest $request, ItemCard $itemCard)
    {
        $data = $request->validated();
        // dd($data);

        if ($request->photo) {

            $path = upload_image($request->file('photo'), 'uploads/images');
            $data['photo'] = $path;
        }

        $itemCard->update($data);

        return redirect()->route('admin.item-cards.index')->with('message', 'تم تحديث الصنف بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     if (!empty($this->attributes['photo']) && Storage::disk('public')->exists($this->attributes['photo'])) {
    //         Storage::disk('public')->delete($this->attributes['photo']);
    //     }
    // }


    public function destroy(ItemCard $itemCard)
    {
        // Check if the image exists and delete it from the public disk
        if (!empty($itemCard->photo) && Storage::disk('public')->exists($itemCard->photo)) {
            Storage::disk('public')->delete($itemCard->photo);
        }

        // Delete the item from the database
        $itemCard->delete();

        // Redirect to the index page with a success message
        return redirect()->route('admin.item-cards.index')->with('message', 'تم حذف الصنف بنجاح');
    }
}
