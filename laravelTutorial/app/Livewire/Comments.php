<?php

namespace App\Livewire;

use App\Models\Comments as ModelsComments;
use App\Models\Products;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Comments extends Component
{
    use WithFileUploads;

    public $rate_level;
    public $description;
    public $user_id;
    public $product_id;
    public $image;
    public $users = [];
    public $products = [];
    public $rateLevel = null;

    protected $rules = [
        'rate_level' => 'required|integer|min:1|max:5',
        'description' => 'required|string',
        'user_id' => 'required|exists:users,id',
        'product_id' => 'required|exists:products,id',
        'image' => 'nullable|image|max:2048',
    ];

    protected $messages = [
        'rate_level.required' => 'Vui lòng nhập mức đánh giá (1-5)',
        'description.required' => 'Vui lòng đánh giá của bạn',
        'user_id.required' => 'Vui lòng chọn người dùng',
        'product_id.required' => 'Vui lòng chọn sản phẩm',
    ];

    public function mount()
    {
        $this->users = User::role('user')->get();
        $this->products = Products::all();
    }

    public function submit()
    {
        $validated = $this->validate();

        $comment = ModelsComments::create($validated);

        if ($this->image) {
            $comment->addMedia($this->image->getRealPath())
                ->usingName($this->image->getClientOriginalName())
                ->toMediaCollection('comment_images');
        }

        $this->reset();
        $this->dispatch('initChartAndTooltip');
        $this->dispatch('showSuccess', 'Đánh giá đã được tạo thành công!');
    }

    public function getCountRateLevel()
    {
        $query = ModelsComments::query();

        $results = $query->selectRaw('rate_level, COUNT(*) as count')
            ->groupBy('rate_level')
            ->pluck('count', 'rate_level');

        $rateLevels = collect();

        foreach (range(1, 5) as $level) {
            $rateLevels[$level] = $results[$level] ?? 0;
        };
        return $rateLevels;
    }

    public function render()
    {

        $query = ModelsComments::with(['user', 'product']);

        if ($this->rateLevel) {
            $query->where('rate_level', $this->rateLevel);
        }

        $comments = $query->where('is_reply', false)->paginate(8);
        $this->dispatch('updateChart', rateLevels: $this->getCountRateLevel());

        return view('livewire.comments')->with([
            'comments' => $comments,
            'rateLevels' => $this->getCountRateLevel(),
            'users' => $this->users,
            'products' => $this->products,
        ]);
    }
}
